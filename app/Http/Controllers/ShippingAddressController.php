<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;

class ShippingAddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->shippingAddresses;
        return view('profile.addresses.addresses', compact('addresses'));
    }

    public function create()
    {
        return view('profile.addresses.create-addresses');
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient_name' => 'required',
            'phone' => 'required|digits:10',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'address' => 'required',
        ]);

        ShippingAddress::create([
            'user_id' => Auth::id(),
            'recipient_name' => $request->recipient_name,
            'phone' => $request->phone,
            'city' => $request->city,
            'district' => $request->district,
            'ward' => $request->ward,
            'address' => $request->address,
            'is_default' => false
        ]);

        return redirect()->route('profile.addresses')
            ->with('success', 'Thêm địa chỉ thành công!');
    }

    public function edit($id)
    {
        $address = ShippingAddress::where('user_id', Auth::id())
                    ->findOrFail($id);

        return view('profile.edit-address', compact('address'));
    }

    public function update(Request $request, $id)
    {
        $address = ShippingAddress::where('user_id', Auth::id())
                    ->findOrFail($id);

        $request->validate([
            'recipient_name' => 'required',
            'phone' => 'required|digits:10',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'address' => 'required',
        ]);

        $address->update([
            'recipient_name' => $request->recipient_name,
            'phone' => $request->phone,
            'city' => $request->city,
            'district' => $request->district,
            'ward' => $request->ward,
            'address' => $request->address,
        ]);

        return redirect()->route('profile.addresses')
            ->with('success', 'Cập nhật địa chỉ thành công!');
    }

    public function destroy($id)
    {
        $address = ShippingAddress::where('user_id', Auth::id())
                    ->findOrFail($id);

        $address->delete();

        return redirect()->route('profile.addresses')
            ->with('success', 'Xóa địa chỉ thành công!');
    }


}