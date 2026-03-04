<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::latest()
            ->paginate(8); 

        $categories = Category::with('products')->get();

        return view('home', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);

        $products = $category->products() 
            ->latest()
            ->paginate(8); 

        return view('home', [
            'categories' => Category::with('products')->get(),
            'products' => $products,
            'currentCategory' => $category
        ]);
    }
}