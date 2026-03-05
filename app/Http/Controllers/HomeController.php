<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
    
        $products = Product::with('category')
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        })
        ->paginate(8);
    
        $categories = Category::with('products')->get();
    
        return view('home', compact('products', 'categories'));
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