<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    /**
     * redirecciona a la vista de pagos
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function index()
    {
        $payments = Payment::all();
        return view('payment.index', compact('payments'));
    }


    /**
     * Redirecciona a la vista de crear pagos
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function viewCreate()
    {
        return view('payment.create');
    }


    /**
     * Creación de pagos
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function create(Request $request)
    {
        $attributes = $request->validate([
            'amount' => 'required|numeric',
            'payment_type_id' => 'required|exists:payment_type,id',
            'note' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'payment_method_id' => 'nullable|exists:payment_methods,id',
            'box_id' => 'nullable|exists:sales_box,id',
            'voucher_number' => 'nullable|string|max:245',
            'bank_id' => 'nullable|exists:banks,id',
            'transaction_id' => 'required|exists:transactions,id',
            'card_cd' => 'nullable|integer',
            'franchise_id' => 'nullable|exists:franchise,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'payment_status' => 'nullable|integer',
            'payment_date' => 'required|date',
            'payment_reason_rejection' => 'nullable|string|max:100',
        ]);
        $attributes['status'] = 'active';
        $attributes['registered_by'] = Auth::user()->id;
        Payment::create($attributes);

        return redirect()->route('payment-index');
    }


    /**
     * Redirecciona a la vista de pagos
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function view($id)
    {
        $payment = Payment::find($id);
        return view('payment.view', compact('payment'));
    }

    /**
     * Actualiza los pagos
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function update($id, Request $request)
    {

        $payment = Payment::find($id);
        $attributes = $request->validate([
            'amount' => 'sometimes|required|numeric',
            'payment_type_id' => 'sometimes|required|exists:payment_type,id',
            'note' => 'nullable|string',
            'payment_method_id' => 'nullable|exists:payment_methods,id',
            'box_id' => 'nullable|exists:sales_box,id',
            'voucher_number' => 'nullable|string|max:245',
            'bank_id' => 'nullable|exists:banks,id',
            'transaction_id' => 'sometimes|required|exists:transactions,id',
            'card_cd' => 'nullable|integer',
            'franchise_id' => 'nullable|exists:franchise,id',
            'warehouse_id' => 'sometimes|required|exists:warehouses,id',
            'payment_status' => 'nullable|integer',
            'payment_date' => 'sometimes|required|date',
            'payment_reason_rejection' => 'nullable|string|max:100',
        ]);
        $attributes['status'] = 'active';
        $attributes['registered_by'] = Auth::user()->id;
        $payment->update($attributes);
        return view('payment.view', compact('payment'));
    }


    /**
     * Eliminación de pagos
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        return redirect()->route('payment-index');
    }
}
