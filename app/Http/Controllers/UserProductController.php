<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class UserProductController extends Controller
{
    public function byCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->where('status', 1)
            ->get();

        return view('shop.category', compact('category', 'products'));
    }
}