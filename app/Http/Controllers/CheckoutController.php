<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $addresses = $user->shippingAddresses;

        $defaultAddress = $addresses
            ->where('is_default', 1)
            ->first();

        $selectedItems = session('selected_cart_items', []);

        $cartItems = \App\Models\Cart::whereIn('id', $selectedItems)
            ->with('product')
            ->get();

        return view('cart.check-out', compact(
            'cartItems',
            'defaultAddress',
            'addresses'
        ));
    }

    public function changeAddress($id)
    {
        $user = Auth::user();

        $user->shippingAddresses()->update(['is_default' => 0]);

        $user->shippingAddresses()
            ->where('id', $id)
            ->update(['is_default' => 1]);

        return back();
    }

    public function placeOrder()
    {
        $user = Auth::user();

        $selectedItems = session('selected_cart_items', []);

        $cartItems = Cart::whereIn('id', $selectedItems)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Không có sản phẩm nào được chọn.');
        }

        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $defaultAddress = $user->shippingAddresses()
            ->where('is_default', 1)
            ->first();

        // Tạo Order
        $order = Order::create([
            'user_id' => $user->id,
            'shipping_address' => $defaultAddress->full_address,
            'total_price' => $total,
            'status' => 'pending'
        ]);

        // Tạo Order Items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        // XÓA khỏi giỏ hàng
        Cart::whereIn('id', $selectedItems)->delete();

        // Xóa session
        session()->forget('selected_cart_items');

        return redirect()->route('checkout.index')
            ->with('success', 'Đặt hàng thành công!');
    }
}