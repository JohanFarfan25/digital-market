<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $suppliers = [];
        $products = [];
        $products = Product::all();
        return getResponse('products.productos', compact('products'));
    }


    public function viewCreate()
    {
        return getResponse('products.crear-producto');
    }


    public function create(Request $request)
    {

        $attributes = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'unit_of_measure' => 'nullable|string|max:50',
            'expiration_date' => 'nullable|date',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'supplier' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'code' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);

        if (request()->hasFile('image')) {
            $image = ImageUploadController::upload(request()->file('image'), 'image', Auth::user()->uuid);
            $attributes['image'] = !empty($image) ? $image : null;
        }

        $attributes['in_stock'] = $attributes['quantity'];
        $attributes['status'] = 'active';
        $attributes['registered_by'] = Auth::user()->id;

        Product::create($attributes);
        return getRedirect('productos');
    }


    public function view($id)
    {
        $product = Product::find($id);
        return getResponse('products.vista-producto', compact('product'));
    }

    public function update($id, Request $request)
    {
        $product = Product::find($id);
        $attributes = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'unit_of_measure' => 'nullable|string|max:50',
            'expiration_date' => 'nullable|date',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'code' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0'
        ]);

        if (request()->hasFile('image')) {
            $image = ImageUploadController::upload(request()->file('image'), 'image', $product->id);
            $attributes['image'] = !empty($image) ? $image : null;
        }
        $attributes['modified_by'] = Auth::user()->id;
        $attributes['in_stock'] = $attributes['quantity'];
        $product->update($attributes);
        return getResponse('products.vista-producto', compact('product'), 'success', 'Los datos se han guardado correctamente.');
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return getRedirect('productos');
    }
}
