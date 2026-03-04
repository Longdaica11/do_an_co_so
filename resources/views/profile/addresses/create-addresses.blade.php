@extends('profile.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile/addresses.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile/create-addresses.css') }}">

<div class="address-wrapper">

    <div class="address-card">
        <h3 class="page-title">Thêm địa chỉ giao hàng</h3>

        <form method="POST" action="{{ route('profile.addresses.store') }}">
            @csrf

            {{-- Tên người nhận --}}
            <div class="form-group">
                <label>Tên người nhận</label>
                <input type="text" name="recipient_name" value="{{ old('recipient_name') }}">
                @error('recipient_name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            {{-- Số điện thoại --}}
            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone" value="{{ old('phone') }}">
                @error('phone')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                {{-- Thành phố --}}
                <div class="form-group">
                    <label>Tỉnh/Thành phố</label>
                    <input type="text" name="city" value="{{ old('city') }}">
                    @error('city')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Quận --}}
                <div class="form-group">
                    <label>Quận/Huyện</label>
                    <input type="text" name="district" value="{{ old('district') }}">
                    @error('district')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Phường --}}
            <div class="form-group">
                <label>Phường/Xã</label>
                <input type="text" name="ward" value="{{ old('ward') }}">
                @error('ward')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            {{-- Địa chỉ chi tiết --}}
            <div class="form-group">
                <label>Địa chỉ cụ thể</label>
                <input type="text" name="address" value="{{ old('address') }}">
                @error('address')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="save-btn">Lưu địa chỉ</button>
        </form>
    </div>

</div>

@endsection