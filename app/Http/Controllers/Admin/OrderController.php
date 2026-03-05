<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'confirmed';
        $order->save();

        return redirect()->back()->with('success', 'Đã xác nhận đơn hàng!');
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('admin.orders.user-orders', compact('orders'));
    }
}
