<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>

    <link rel="stylesheet" href="{{ asset('css/topbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/logo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

@include('partials.topbar')
@include('partials.logo')



<div class="login-wrapper">

    <div class="login-box">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Họ + Tên -->
            <div class="row">
                <input type="text" name="first_name" placeholder="Họ"
                    value="{{ old('first_name') }}" required>
                    @error('first_name')
                        <div class="error-text">{{ $message }}</div>
                    @enderror

                <input type="text" name="last_name" placeholder="Tên"
                    value="{{ old('last_name') }}" required>
                    @error('last_name')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
            </div>

            <input type="email" name="email" placeholder="Tài khoản gmail"
                value="{{ old('email') }}" required>
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror

            <input type="password" name="password" placeholder="Nhập mật khẩu" required>
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror

            <input type="password" name="password_confirmation"
                placeholder="Nhập lại mật khẩu" required>

            <button class="btn-login" type="submit">Đăng ký</button>
        </form>
    </div>
</div>

</body>
</html>
