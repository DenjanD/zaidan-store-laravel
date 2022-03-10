<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carts = Cart::with(['product.photos','user'])
                    ->where('user_id', auth()->user()->user_id)->get();

        return view('pages.cart', [
            'carts' => $carts
        ]);
    }

    public function delete(Request $request, $id) {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route('cart');
    }

    public function success() {
        return view('pages.success');
    }
}