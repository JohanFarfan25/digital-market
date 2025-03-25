<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class BillingController extends Controller
{

    /**
     * redirecciona a la vista de order de venta
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function index()
    {
        $products = Product::all();
        return view('transactions.facturacion', compact('products'));
    }

    /**
     * redirecciona a la vista de orden de compra
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function indexPurchase()
    {
        $products = Product::all();
        return view('transactions.facturacion-compra', compact('products'));
    }

    /**
     * Creación de transacción de venta
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'supplier' => 'nullable|string|max:245',
                'customer_id' => 'nullable|string|max:245',
                'items' => 'required|array', // Recibe como JSON string
            ]);

            // Crear la transacción
            $transaction = Transaction::create([
                'type' => $request->type,
                'date' => date('Y-m-d H:i:s'),
                'supplier' => $request->supplier ?? null,
                'customer' => $request->customer ?? null,
                'quantity' =>  $request->quantity,
                'price' => $request->price,
                'status' => 'active',
                'transaction_status' => 'pending',
                'registered_by' => Auth::user()->id,
                'box_id' => $request->box_id ?? null,
            ]);

            if (isset($transaction->id)) {
                // Guardar los productos/lotes asociados a la transacción
                foreach ($request->items as $item) {
                    $productId = $item['productId'] ?? null;
                    $batchId = null;

                    Item::create([
                        'transaction_id' => $transaction->id,
                        'batch_id' => $batchId,
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                        'price' => $item['subtotal'],
                        'registered_by' => Auth::user()->id,
                    ]);
                }
            }
            return response()->json(["success" => true, "message" => "Transacción creada correctamente.", 'transactionId' => $transaction->id]);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die();
        }
    }

    /**
     * Buscar productos por nombre o código
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function searchProducts(Request $request)
    {
        $query = $request->input('search');

        $products = Product::where('name', 'like', "%$query%")
            ->orWhere('code', 'like', "%$query%")
            ->get();

        return response()->json($products);
    }
}
