<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
    
        $products = Product::latest()->paginate(30); // 30 sản phẩm mỗi trang
    
        return view('home', compact('categories', 'products'));
    }

    public function category($id)
    {
        $category = Category::with('products')->findOrFail($id);

        return view('home', [
            'categories' => Category::all(),
            'products' => $category->products,
            'currentCategory' => $category
        ]);
    }
}