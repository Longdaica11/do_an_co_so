<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // ==============================
    // TRANG CHỦ / SHOP
    // ==============================
    public function index(Request $request)
    {
        $keyword = $request->keyword;
    
        $products = Product::with('category')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->paginate(8);
    
        $categories = Category::all();
    
        return view('home', compact('products', 'categories'));
    }

    // ==============================
    // LỌC THEO DANH MỤC
    // ==============================
    public function category($id)
    {
        $category = Category::findOrFail($id);
    
        $products = Product::where('category_id', $id)->paginate(8);
    
        $categories = Category::all();
    
        return view('home', compact('products', 'categories', 'category'));
    }

    // ==============================
    // CHI TIẾT SẢN PHẨM
    // ==============================
    public function show($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::all();

        return view('admin.product.show', [
            'product' => $product,
            'categories' => $categories
        ]);
    }
}