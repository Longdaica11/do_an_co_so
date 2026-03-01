<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/topbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/logo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    {{-- TOPBAR --}}
    @include('partials.topbar')

    {{-- LOGO --}}
    @include('partials.logo')

    {{-- LOGIN FORM --}}
    <div class="login-wrapper">
        <div class="login-box">
            <h2>Đăng nhập tài khoản</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" name="email" placeholder="Tên đăng nhập" value="{{ old('email') }}" required>

                <input type="password" name="password" placeholder="Mật khẩu" required>

                {{-- QUÊN MẬT KHẨU --}}
                <a href="#" class="forgot">Quên mật khẩu?</a>

                {{-- NÚT ĐĂNG NHẬP --}}
                <button type="submit" class="btn-login">
                    Đăng nhập
                </button>

                {{-- THÔNG BÁO ĐĂNG NHẬP SAI --}}
                @if ($errors->has('login_error'))
                    <div class="login-error">
                        {{ $errors->first('login_error') }}
                    </div>
                @endif

                
                {{-- GẠCH NGĂN --}}
                <div class="divider"></div>

                {{-- NÚT ĐĂNG KÝ --}}
                <a href="{{ route('register') }}" class="btn-register">
                    Đăng ký
                </a>
            </form>
        </div>
    </div>
</body>
</html>
