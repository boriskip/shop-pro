<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);

        // Check inventory only if the column exists
        if (Schema::hasColumn('products', 'inventory_count') && $product->inventory_count < $quantity) {
            return redirect()->back()->with('error', 'Not enough inventory available.');
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'is_downloadable' => $product->is_downloadable,
                'image' => $product->image_url,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function index()
    {
        return view('cart.index');
    }
}
