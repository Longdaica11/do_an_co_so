@extends('profile.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile/create-addresses.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile/logo-left.css') }}">

<div class="profile-content-wrapper">

    <div class="profile-card">
        <h3 class="page-title">Chỉnh sửa địa chỉ</h3>

        <form class="address-form" 
              method="POST" 
              action="{{ route('profile.addresses.update', $address->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tên người nhận</label>
                <input type="text" name="recipient_name" 
                       value="{{ old('recipient_name', $address->recipient_name) }}">
            </div>

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone" 
                       value="{{ old('phone', $address->phone) }}">
            </div>

            <div class="form-group">
                <label>Tỉnh/Thành phố</label>
                <input type="text" name="city" 
                       value="{{ old('city', $address->city) }}">
            </div>

            <div class="form-group">
                <label>Quận/Huyện</label>
                <input type="text" name="district" 
                       value="{{ old('district', $address->district) }}">
            </div>

            <div class="form-group">
                <label>Phường/Xã</label>
                <input type="text" name="ward" 
                       value="{{ old('ward', $address->ward) }}">
            </div>

            <div class="form-group">
                <label>Địa chỉ cụ thể</label>
                <input type="text" name="address" 
                       value="{{ old('address', $address->address) }}">
            </div>

            <button type="submit" class="save-btn">Cập nhật</button>

        </form>
    </div>

</div>

@endsection