<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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

    public function show($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
    
    public function search(Request $request)
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
}