<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $product = Product::with(['photos','user'])->where('slug', $id)->firstOrFail();
        
        return view('pages.detail', [
            'product' => $product
        ]);
    }

    public function add(Request $request, $id) {
        $data = [
            'product_id' => $id,
            'user_id' => auth()->user()->user_id
        ];
        
        Cart::create($data);

        return redirect()->route('cart');
    }
}
