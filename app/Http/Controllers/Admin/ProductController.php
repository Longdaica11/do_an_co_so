<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(30);
        return view('admin.dashboard', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create-product', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                                 ->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Thêm sản phẩm thành công');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.product.edit-product', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Nếu có ảnh mới
        if ($request->hasFile('image')) {

            // Xóa ảnh cũ nếu tồn tại
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // Lưu ảnh mới
            $imagePath = $request->file('image')
                                 ->store('products', 'public');

            $product->image = $imagePath;
        }

        // Cập nhật thông tin khác
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->description = $request->description;

        $product->save();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Xóa ảnh khi xóa sản phẩm
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Xóa thành công');
    }

    public function byCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
    
        $products = $category
            ->products()
            ->latest()
            ->paginate(30);
    
        $categories = Category::all();
    
        return view('user.products.index', compact('products','categories','category'));
    }
}