<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang cá nhân</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/topbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile/logo-left.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile/menu-profile.css') }}">

    {{-- Font Awesome (bạn đang bị sai chữ stylesxheet) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

{{-- TOPBAR --}}
@include('partials.topbar')

{{-- LOGO BÊN TRÁI --}}
@include('profile.logo-left')

{{-- KHUNG PROFILE --}}
<div class="profile-wrapper">

    {{-- LEFT: AVATAR (chỉ hiện ở trang info) --}}
    @hasSection('avatar-section')
        <div class="profile-left">
            @yield('avatar-section')
        </div>
    @endif

    {{-- CENTER: CONTENT --}}
    <div class="profile-content">
        @yield('content')    
    </div>

    {{-- RIGHT: MENU --}}
    <div class="profile-sidebar">
        @include('profile.menu')
    </div>

</div>

</body>
</html>