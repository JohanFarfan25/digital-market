<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Redirecciona a la vista de transacciones
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Crear transacción de venta
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function create(Request $request)
    {

        $attributes = $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'warehouse_id' => 'required|exists:warehouses,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'customer_id' => 'nullable|exists:customers,id'
        ]);
        $attributes['date'] = date('Y-m-d H:i:s');
        $attributes['type'] = 'sale';
        $attributes['status'] = 'active';
        $attributes['registered_by'] = Auth::user()->id;

        Transaction::create($attributes);

        return redirect()->route('transactions-index');
    }


    /**
     * Redirecciona a la vista de transacciones
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function view($id)
    {
        $transaction = Transaction::find($id);
        if (!is_null($transaction->reson_rejection) && json_decode($transaction->reson_rejection)) {
            $reson_rejection = json_decode($transaction->reson_rejection);
            $transaction->reson_rejection = isset($reson_rejection[0]->errorMessage) ? '¡' . $reson_rejection[0]->errorMessage . ' !' : $transaction->reson_rejection . '!';
        }
        $items = $transaction->items;
        $payments = Payment::where('transaction_id', $id)->get();
        $payResult = [];
        $diferece = 0;
        $this->assingPayResultCalculateDiference($payments, $payResult, $diferece);
        return view('transactions.ver-transaccion', compact('transaction', 'items', 'payResult'));
    }

    /**
     * Actuliza la transaccion
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function update($id, Request $request)
    {
        $transaction = Transaction::find($id);

        $attributes = $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'type' => 'required|in:purchase,sale,adjustment',
            'date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'warehouse_id' => 'required|exists:warehouses,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'customer_id' => 'nullable|exists:customers,id'
        ]);

        $transaction->update($attributes);
        return getResponse('transactions.ver-transaccion', compact('transaction'), 'success', 'Los datos se han guardado correctamente.');
    }


    /**
     * Elimina la transacción
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();
        return redirect()->route('transactions-index');
    }

    /**
     * Asigna los pagos y calcula la diferencia de la transacción
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    private function assingPayResultCalculateDiference($payments, &$payResult, &$diferece)
    {
        foreach ($payments as $pay) {
            $diferece -= $pay->amount;
            array_push($payResult, [
                'paymentTypeName' => isset($pay->payment_type) ? $pay->payment_type : '---',
                'type' => isset($pay->payment_type) ? $pay->payment_type : '---',
                'amount' => number_format($pay->amount, 0, ',', '.'),
                'frachise' => isset($pay->franchise) ?  $pay->franchise : '---',
                'bank' => isset($pay->bank) ? $pay->bank : '---',
                'voucherNumber' => $pay->voucher_number,
                'cardCd' => $pay->card_cd
            ]);
        }
    }

    /**
     * retorna la vista de proceso de pago de la transacción
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function payment($transactionId, $message = '', $status = 'success')
    {
        $transaction = Transaction::find($transactionId);
        $paymentTypes = PaymentType::all();
        $items = $transaction->items;
        $diferece =  $transaction->price;
        $payments = Payment::where('transaction_id', $transactionId)->get();
        $payResult = [];
        $this->assingPayResultCalculateDiference($payments, $payResult, $diferece);
        $diferece = number_format($diferece, 0, ',', '.');

        return getResponse('transactions.proceso-de-pago', compact('transactionId', 'transaction', 'items', 'paymentTypes', 'diferece', 'payResult'), $status, $message);
    }

    /**
     * Agrerga el pago a la transacción de la venta o compra
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    private function addPayment($request, $amount, $transactionId, $paymentReasonRejection)
    {
        try {
            return Payment::create(
                [
                    'amount' => $amount,
                    'payment_type' => ($request->payment_type) ? $request->payment_type : null,
                    'note' => ($request->note) ?  $request->note : null,
                    'payment_method_id' => ($request->payment_method_id) ?  $request->payment_method_id : null,
                    'box_id' => ($request->box_id) ? $request->box_id : null,
                    'voucher_number' => ($request->voucher_number) ? $request->voucher_number : null,
                    'bank_id' => ($request->bank_id) ? $request->bank_id : null,
                    'transaction_id' =>   $transactionId,
                    'card_cd' => ($request->card_cd) ? $request->card_cd : null,
                    'franchise_id' => ($request->franchise_id) ? $request->franchise_id : null,
                    'warehouse_id' => Auth::user()->warehouse_id,
                    'payment_status' => 1,
                    'payment_date' => date('Y-m-d H:i:s'),
                    'payment_reason_rejection' => $paymentReasonRejection,
                    'registered_by' => Auth::user()->id,
                    'status' => 'active',
                ]
            );
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die;
        }
    }

    /**
     * Resta la cantidad de productos en stock de la transacción de venta o compra
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    private function subtractQuantityOfProductsInStock($items)
    {
        foreach ($items as $item) {
            $product = $item->product;
            if (isset($product->id)) {
                $product->in_stock -= $item->quantity;
                $product->save();
            }
        }
    }

    /**
     * Crear transacción de venta o compra
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function paymentTransaction(Request $request)
    {
        $transactionId = $request->transactionId;
        $amount = $request->amount;
        $paymentReasonRejection = '';
        $payResult = [];

        $payments = Payment::where('transaction_id', $transactionId)->get();
        $transaction = Transaction::find($transactionId);
        $items = $transaction->items;
        $box = $transaction->box;

        if ($transaction->type == 'purchase' && isset($box->id) && $amount > $box->cash_initial && $request->payment_type == 'cash') {
            return $this->payment($transactionId, 'El monto ingresado $' . $amount . ' es mayor al valor disponnible de efectivo en caja: ' . $box->cash_initial, 'error');
        }

        $diferece =  $transaction->price;
        $this->assingPayResultCalculateDiference($payments, $payResult, $diferece);

        if (($amount > $transaction->price) || ($amount > $diferece)) {
            return $this->payment($transactionId, 'El monto ingresado $' . $amount . ' es mayor al valor a pagar');
        } elseif ($diferece > 0) {

            $payment = $this->addPayment($request, $amount, $transactionId, $paymentReasonRejection);

            if (isset($payment->id)) {
                $diferece -= $payment->amount;
            }

            if (isset($box->id)) {

                $box->total += $payment->amount;
                if ($request->payment_type == 'cash') {
                    ($transaction->type == 'purchase') ? $box->cash_initial -= $payment->amount : $box->cash_initial += $payment->amount;
                }

                if (!$box->save()) {
                    return $this->payment($transactionId, 'Error al actualizar el valor ingresado en caja ' + $box->getErrors());
                }
                $payment->box_id = $box->id;
                if (!$payment->save()) {
                    return $this->payment($transactionId, 'Error al asignar la caja al pago ' + $payment->getErrors());
                }
            }
        }

        if ($diferece == 0) {
            $transaction->transaction_status = 'completed';
            $transaction->save();
            $this->subtractQuantityOfProductsInStock($items);
            $compact = compact('transaction', 'items');
            if ($transaction->transaction_status == 'completed') {
                $compact = compact('transaction', 'items', 'payResult');
            }
            return view('transactions.ver-transaccion', $compact);
        }

        return $this->payment($transactionId, 'Pago realizado correctamente');
    }

    /**
     * Cancela la transacción de venta o compra
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function cancelled($id)
    {
        $transaction = Transaction::find($id);
        $transaction->transaction_status = 'cancelled';
        $transaction->edited_by = Auth::user()->id;
        $transaction->save();
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }
}
