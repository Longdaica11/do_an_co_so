<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $products = Product::where('status', 1)
                            ->latest()
                            ->take(8) // lấy 8 sản phẩm mới
                            ->get();

        return view('home', compact('categories', 'products'));
    }
}