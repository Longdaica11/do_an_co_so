@extends('profile.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile/addresses.css') }}">

<h3>Thêm địa chỉ giao hàng</h3>

<form method="POST" action="{{ route('profile.addresses.store') }}">
    @csrf

    {{-- Tên người nhận --}}
    <div>
        <label>Tên người nhận</label><br>
        <input type="text" name="recipient_name" value="{{ old('recipient_name') }}">
        @error('recipient_name')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>
    <br>

    {{-- Số điện thoại --}}
    <div>
        <label>Số điện thoại</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}">
        @error('phone')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>
    <br>

    {{-- Thành phố --}}
    <div>
        <label>Thành phố</label><br>
        <input type="text" name="city" value="{{ old('city') }}">
        @error('city')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>
    <br>

    {{-- Quận --}}
    <div>
        <label>Quận</label><br>
        <input type="text" name="district" value="{{ old('district') }}">
        @error('district')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>
    <br>

    {{-- Phường --}}
    <div>
        <label>Phường</label><br>
        <input type="text" name="ward" value="{{ old('ward') }}">
        @error('ward')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>
    <br>

    {{-- Địa chỉ chi tiết --}}
    <div>
        <label>Địa chỉ cụ thể</label><br>
        <input type="text" name="address" value="{{ old('address') }}">
        @error('address')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>
    <br>

    <button type="submit">Lưu địa chỉ</button>
</form>