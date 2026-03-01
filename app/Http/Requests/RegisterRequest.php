<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Họ không được để trống',
            'last_name.required'  => 'Tên không được để trống',
            'email.required'      => 'Email không được để trống',
            'email.email'         => 'Email không hợp lệ',
            'email.unique'        => 'Email đã tồn tại',
            'password.required'   => 'Mật khẩu không được để trống',
            'password.min'        => 'Mật khẩu phải ít nhất 6 ký tự',
            'password.confirmed'  => 'Mật khẩu nhập lại không khớp',
        ];
    }
}
