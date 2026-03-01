<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Hiển thị thông tin
    public function show()
    {
        $user = Auth::user();
        return view('profile.pages.info', compact('user'));
    }

    // Form chỉnh sửa
    public function edit()
    {
        $user = Auth::user();   // Lấy user đang đăng nhập

        return view('profile.pages.edit-profile', compact('user'));
    }

    // Cập nhật
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns',
            'phone' => 'nullable|digits:10',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'email.email' => 'Email không hợp lệ.',
            'phone.digits' => 'Số điện thoại phải đúng 10 chữ số.',
        ]);
    
        $user = \App\Models\User::findOrFail(Auth::id());
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
    
        // Nếu có upload avatar mới
        if ($request->hasFile('avatar')) {
    
            // Xóa ảnh cũ nếu có
            if ($user->avatar && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }
    
            // Lưu ảnh mới vào storage/app/public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');
    
            // Lưu tên file vào database
            $user->avatar = basename($path);
        }
    
        $user->save();
    
        return redirect()->route('profile.info')
            ->with('success', 'Cập nhật thành công!');
    }
}