@extends('profile.layout')

@section('profile-content')

<link rel="stylesheet" href="{{ asset('css/profile/info.css') }}">

<div class="profile-main">

    {{-- LEFT: AVATAR --}}
    <div class="profile-left">
        <div class="avatar-box">
            <img src="{{ Auth::user()->avatar 
                ? asset('storage/avatars/' . Auth::user()->avatar) 
                : asset('images/default-avatar.png') }}" 
                 alt="Avatar">
        </div>
        <p class="text-avt">Ảnh đại diện</p>
    </div>

    {{-- RIGHT: INFO --}}
    <div class="profile-right">

        <h2 class="profile-page-title">Thông tin cá nhân</h2>

        <div class="profile-info-box">

            <div class="profile-info-row">
                <span class="label">Họ tên</span>
                <span class="value">
                    {{ Auth::user()->name ?? 'Chưa khai báo' }}
                </span>
            </div>

            <div class="profile-info-row">
                <span class="label">Email</span>
                <span class="value">
                    {{ Auth::user()->email ?? 'Chưa khai báo' }}
                </span>
            </div>

            <div class="profile-info-row">
                <span class="label">Giới tính</span>
                <span class="value">
                    {{ Auth::user()->gender ?? 'Chưa cập nhật' }}
                </span>
            </div>

            <div class="profile-info-row">
                <span class="label">Số điện thoại</span>
                <span class="value">
                    {{ Auth::user()->phone ?? 'Chưa cập nhật' }}
                </span>
            </div>

        </div>

        <div class="profile-edit-btn">
            <a href="{{ route('profile.edit') }}" class="btn-edit">
                Chỉnh sửa
            </a>
        </div>

    </div>

</div>

@endsection