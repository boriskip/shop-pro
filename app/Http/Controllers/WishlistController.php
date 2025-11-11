<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index()
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to view your wishlist');
        }

        $wishlist = auth()->user()->wishlist()->with('product')->get();
        return view('wishlist.index', compact('wishlist'));
    }

    public function add(Product $product)
    {
        // If user is not authenticated, use session-based wishlist
        if (!auth()->check()) {
            $sessionWishlist = Session::get('wishlist', []);
            if (!in_array($product->id, $sessionWishlist)) {
                $sessionWishlist[] = $product->id;
                Session::put('wishlist', $sessionWishlist);
            }
            return redirect()->back()->with('success', 'Product added to wishlist');
        }

        // For authenticated users, save to database
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist');
    }

    public function remove(Product $product)
    {
        // If user is not authenticated, remove from session
        if (!auth()->check()) {
            $sessionWishlist = Session::get('wishlist', []);
            $sessionWishlist = array_filter($sessionWishlist, function ($id) use ($product) {
                return $id !== $product->id;
            });
            Session::put('wishlist', array_values($sessionWishlist));
            return redirect()->back()->with('success', 'Product removed from wishlist');
        }

        // For authenticated users, remove from database
        auth()->user()->wishlist()->where('product_id', $product->id)->delete();
        return redirect()->back()->with('success', 'Product removed from wishlist');
    }

    public function share()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to share your wishlist');
        }

        $shareToken = Str::random(32);
        auth()->user()->wishlist()->update(['share_token' => $shareToken]);
        return redirect()->route('wishlist.index')->with('share_url', route('wishlist.shared', $shareToken));
    }

    public function sharedWishlist($shareToken)
    {
        $wishlist = Wishlist::where('share_token', $shareToken)->with('product')->get();

        if ($wishlist->isEmpty()) {
            return redirect()->route('products.index')->with('error', 'Shared wishlist not found');
        }

        return view('wishlist.shared', compact('wishlist'));
    }
}
