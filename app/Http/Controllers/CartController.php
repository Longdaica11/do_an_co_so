<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // HIỂN THỊ GIỎ HÀNG
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    // THÊM VÀO GIỎ
    public function add(Product $product)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // XOÁ
    public function deleteSelected(Request $request)
    {
        if ($request->has('selected_items')) {
            Cart::whereIn('id', $request->selected_items)
                ->where('user_id', Auth::id()) // 👈 sửa ở đây
                ->delete();
        }
    
        return redirect()->back()->with('success', 'Đã xóa sản phẩm đã chọn');
    }

    // CẬP NHẬT
    public function update(Request $request, Product $product)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->update([
                'quantity' => $request->quantity
            ]);

        return back()->with('success', 'Cập nhật thành công!');
    }

    // CLEAR
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        return back()->with('success', 'Đã xoá toàn bộ giỏ hàng!');
    }

    public function goToCheckout(Request $request)
    {
        if (!$request->selected_items) {
            return back()->with('error', 'Vui lòng chọn sản phẩm');
        }

        // Lưu vào session
        session(['selected_cart_items' => $request->selected_items]);

        return redirect()->route('checkout.index');
    }
}