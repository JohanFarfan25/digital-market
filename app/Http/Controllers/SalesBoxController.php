<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\SalesBox;
use App\Models\Transaction;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SalesBoxController extends Controller
{

    /**
     * Obtener la caja abierta por el usuario
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    private function getSessionOpenBox()
    {
        return SalesBox::where('status_box', 'open')
            ->where('registered_by', Auth::user()->id)
            ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
            ->first();
    }

    /**
     * Validar si el usuario tiene una caja abierta
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function validateBoxOpenByUser()
    {
        $status = 'success';
        $boxId = null;
        $box = $this->getSessionOpenBox();
        if (isset($box->id)) {
            $boxId = $box->id;
        } else {
            $status = 'error';
        }
        return response()->json(['status' => $status, 'boxId' => $boxId]);
    }


    /**
     * Abrir caja para el usuario logueado
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function openBox(Request $request)
    {
        try {

            $dataBox =  [
                'cash_initial' => is_numeric($request->cash_initial) ? (float) $request->cash_initial : 0.0,
                'base' => is_numeric($request->base) ? (float) $request->base : 0.0,
                'total' => is_numeric($request->total) ? (float) $request->total : 0.0,
                'status_box' => 'open',
                'status' => 'active',
                'registered_by' => Auth::user()->id
            ];

            $box = SalesBox::create($dataBox);

            return response()->json(['status' => 'success', 'message' => 'Caja abierta correctamente.', 'boxId' => $box->id]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


    /**
     * Vista de la caja abierta por el usuario logueado
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function view()
    {
        try {
            $box = [];
            $totals = [];
            $boxSession = $this->getSessionOpenBox();
            if (!isset($boxSession->id)) {
                return getResponse('dashboard', compact('box'), 'error', 'No tiene caja abierta, o la caja ya feu cerrada');
            }
            $dataBox = $this->getDataSalesBox($boxSession->id ?? 0);
            if ($dataBox->status == 'error') {
                return getResponse('dashboard', compact('box'), 'error', $dataBox->message);
            }
            $box = $dataBox->box;

            $totals = $dataBox->totals;
            return getResponse('box.view', compact('box', 'totals'));
        } catch (\Exception $e) {
            return getResponse('dashboard', compact('box'), 'error', $e->getMessage());
        }
    }


    /**
     * Obtener los datos de la caja abierta por el usuario logueado
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function getDataSalesBox($id)
    {
        try {
            $totals = [
                'base' => 0,
                'cash' => 0,
                'credit card' => 0,
                'debit card' => 0,
                'check' => 0,
                'transfer' => 0,
                'deposit' => 0,
                'other' => 0,
                'purchase' => 0,
                'sale' => 0,
                'adjustment' => 0,
                'total' => 0,
                'payments' => [],
                'date' => '',
                'base' => 0,
                'user' => [
                    'name' => '',
                    'email' => ''
                ],
                'status' => 'Cerrada'
            ];
            $typeTransactions = [
                'purchase' => 0,
                'sale' => 0,
                'adjustment' => 0,
            ];
            $box = $this->getSessionOpenBox() ?? [];
            if (isset($box->id)) {
                $totals['status'] = ($box->status_box == 'open') ? 'Abierta' : 'Cerrada';
                $date = (new DateTime($box->created_at))->format('Y-m-d');
                $totals['date'] = $date;
                $totals['base'] = $box->base;
                $totals['cash'] = $box->base;
                $payments = Payment::where('box_id', $box->id)->get();
                $transactions = Transaction::where('box_id', $box->id)->get();
                $user = User::find($box->registered_by);

                $totals['user'] = [
                    'name' => $user->name,
                    'email' => $user->email
                ];

                foreach ($payments as $key => &$payment) {
                    $transactionPay = Transaction::find($payment->transaction_id);
                    $payment->transactionType = $transactionPay->type;
                    if (isset($transactionPay->id) && $transactionPay->type == 'purchase') {
                        $totals[$payment->payment_type] -= $payment->amount;
                    } else {
                        $totals[$payment->payment_type] += $payment->amount;
                    }
                }

                foreach ($transactions as $key => $transaction) {
                    $typeTransactions[$transaction->type] += $transaction->price;
                }

                $totals['purchase'] = $typeTransactions['purchase'];
                $totals['sale'] = $typeTransactions['sale'];
                $totals['adjustment'] = $typeTransactions['adjustment'];
                $totals['total'] = ($totals['sale'] - $totals['purchase']) + $totals['base'];
                $totals['payments'] = $payments ?? [];

                return (object) ['status' => 'success', 'box' => $box, 'totals' => $totals];
            } else {
                return (object) ['status' => 'error', 'message' => 'No tiene caja abierta, o la caja ya feu cerrada'];
            }
        } catch (\Exception $e) {
            return getResponse('box.view', compact('box'), 'error', $e->getMessage());
        }

        return view('box.view', compact('box'));
    }

    /**
     * Obtener las cajas de ventas por fecha
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function getSalesBoxesByDate($date)
    {
        try {
            $boxes = SalesBox::whereBetween('created_at', [new DateTime($date . ' 00:00:00'), new DateTime($date . ' 23:59:59')])
                ->get();
            if ($boxes->count() == 0) {
                return (object)['status' => 'error', 'message' => 'No se encontraron cajas para la fecha seleccionada.'];
            }
            return (object)['status' => 'success', 'boxes' => $boxes];
        } catch (\Exception $e) {
            return (object) ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Reporte de cajas de ventas por fecha
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function reporByDate(request $request)
    {
        try {
            $resultBoxes = [];
            $date = $request->date ?? now()->format('Y-m-d');
            $boxes = $this->getSalesBoxesByDate($date);
            $grandTotalCash = 0;
            $grandTotalCreditCard = 0;
            $grandTotalDebiCard = 0;
            $grandTotalPurchase = 0;
            $grandTotalSale = 0;
            $grandTotalBase = 0;
            $grandTotal = 0;

            if ($boxes->status == 'success') {

                foreach ($boxes->boxes as $key => $box) {

                    $totals = [
                        'id' => $box->id,
                        'base' => 0,
                        'cash' => 0,
                        'credit card' => 0,
                        'debit card' => 0,
                        'check' => 0,
                        'transfer' => 0,
                        'deposit' => 0,
                        'other' => 0,
                        'purchase' => 0,
                        'sale' => 0,
                        'adjustment' => 0,
                        'total' => 0,
                        'payments' => [],
                        'base' => 0,
                        'user' => [
                            'name' => '',
                            'email' => ''
                        ],
                        'status' => ($box->status_box == 'open') ? 'Abierta' : 'Cerrada'
                    ];
                    $typeTransactions = [
                        'purchase' => 0,
                        'sale' => 0,
                        'adjustment' => 0,
                    ];

                    $creted_at = $box->created_at;
                    $totals['base'] = $box->base;
                    $totals['cash'] = $box->base;
                    $payments = Payment::where('box_id', $box->id)->get();
                    $transactions = Transaction::where('box_id', $box->id)->get();
                    $user = User::find($box->registered_by);

                    $totals['user'] = [
                        'name' => $user->name,
                        'email' => $user->email
                    ];

                    foreach ($payments as $key => &$payment) {
                        $transactionPay = Transaction::find($payment->transaction_id);
                        $payment->transactionType = $transactionPay->type;
                        if (isset($transactionPay->id) && $transactionPay->type == 'purchase') {
                            $totals[$payment->payment_type] -= $payment->amount;
                        } else {
                            $totals[$payment->payment_type] += $payment->amount;
                        }
                    }

                    foreach ($transactions as $key => $transaction) {
                        $typeTransactions[$transaction->type] += $transaction->price;
                    }

                    $totals['purchase'] = $typeTransactions['purchase'];
                    $totals['sale'] = $typeTransactions['sale'];
                    $totals['adjustment'] = $typeTransactions['adjustment'];
                    $totals['total'] = ($totals['sale'] - $totals['purchase']) + $totals['base'];
                    $totals['payments'] = $payments ?? [];

                    $resultBoxes[] = ['box' => $box, 'totals' => $totals];

                    $grandTotalCash += $totals['cash'];
                    $grandTotalCreditCard += $totals['credit card'];
                    $grandTotalDebiCard += $totals['debit card'];
                    $grandTotalPurchase += $totals['purchase'];
                    $grandTotalSale += $totals['sale'];
                    $grandTotalBase += $totals['base'];
                    $grandTotal += $totals['total'];
                }

                return getResponse('box.sales-report',  compact('resultBoxes', 'date', 'grandTotalCash', 'grandTotalCreditCard', 'grandTotalDebiCard', 'grandTotalBase', 'grandTotalSale', 'grandTotalPurchase', 'grandTotal'), 'success', 'Reporte generado correctamente.');
            } else {
                return getResponse('box.sales-report',  compact('resultBoxes', 'date', 'grandTotalCash', 'grandTotalCreditCard', 'grandTotalDebiCard', 'grandTotalBase', 'grandTotalSale', 'grandTotalPurchase', 'grandTotal'), 'error', $boxes->message);
            }
        } catch (\Exception $e) {
            return getResponse('box.sales-report',  compact('resultBoxes', 'date', 'grandTotalCash', 'grandTotalCreditCard', 'grandTotalDebiCard', 'grandTotalBase', 'grandTotalSale', 'grandTotalPurchase', 'grandTotal'), 'error', $e->getMessage());
        }

        return view('box.view', compact('box'));
    }

    /**
     * Cerrar caja de ventas por id de caja de ventas
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function closeBox($id)
    {
        try {
            $box = $this->getSessionOpenBox();
            if (isset($box->id)) {
                $box = SalesBox::find($id);
                $box->edited_by = Auth::user()->id;
                $box->status_box = 'close';
                $box->save();
            }
            return (new HomeController)->dashboard();
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Actualizar caja de ventas por id de caja de ventas y request de datos de caja de ventas a actualizar
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function update($id, Request $request)
    {

        $box = SalesBox::find($id);
        $attributes = $request->validate([
            'cash_less' => 'sometimes|required|numeric',
            'cash_initial' => 'sometimes|required|numeric',
            'base' => 'sometimes|required|numeric',
            'baucher' => 'sometimes|required|numeric',
            'total' => 'sometimes|required|numeric',
            'warehouse_id' => 'nullable|exists:warehouses,id',
            'status_box' => 'sometimes|required|in:open,close'
        ]);
        $box->update($attributes);
        return getResponse('box.view', compact('box'), 'success', 'Los datos se han guardado correctamente.');
    }
}
