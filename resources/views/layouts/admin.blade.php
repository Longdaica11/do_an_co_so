<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin - Gym Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS CHÍNH -->
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">

    @stack('styles')
</head>
<body>

<div class="admin-wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Gym Store</h2>

        <ul>
            <li><a href="{{ route('admin.products.index') }}">Quản lí sản phẩm</a></li>
            <li><a href="#">Quản lí danh mục</a></li>
            <li><a href="#">Danh sách người dùng</a></li>
            <li><a href="#">Quản lí đơn hàng</a></li>
            <li><a href="#">Tin nhắn</a></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <!-- HEADER -->
        <div class="admin-header">
            <h3>Welcome, {{ Auth::user()->name }}</h3>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    Đăng xuất
                </button>
            </form>
        </div>

        @yield('content')

    </div>

</div>

</body>
</html>