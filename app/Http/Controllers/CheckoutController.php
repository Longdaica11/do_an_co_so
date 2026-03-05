<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}