<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPhoto;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductRequest;

class DashboardProductController extends Controller
{
    public function index() {
        $products = Product::with(['photos','category'])
                        ->where('user_id', Auth::user()->user_id)->get();

        return view('pages.dashboard-products', [
            'products' => $products
        ]);
    }

    public function detail(Request $request, $id) {
        $product = Product::with(['photos','user','category'])->findOrFail($id);
        $categories = Category::all();

        return view('pages.dashboard-products-details', [
            'categories' => $categories,
            'products' => $product
        ]);
    }

    public function uploadPhotos(Request $request) {
        $data = $request->all();

        $data['name'] = $request->file('name')->store('assets/product','public');
        
        ProductPhoto::create($data);

        return redirect()->route('dashboard-products-details', $request->product_id);
    }

    public function deletePhotos(Request $request, $id) {
        $item = ProductPhoto::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-products-details', $item->product_id);
    }

    public function create() {
        $categories = Category::all();

        return view('pages.dashboard-products-create', [
            'categories' => $categories
        ]);
    }

    public function store(ProductRequest $request) {
        $data = [
            'name' => $request->name,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description
        ];

        $data['slug'] = Str::slug($request->name);
        
        $product = Product::create($data);

        $photos = [
            'product_id' => $product->product_id,
            'name' => $request->file('photoName')->store('assets/product','public')
        ];

        ProductPhoto::create($photos);

        return redirect()->route('dashboard-product');
    }

    public function update(ProductRequest $request, $id) {
        $data = $request->all();

        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('dashboard-product');
    }
}
