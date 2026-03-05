<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin - Gym Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
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
            <li><a href="{{ route('admin.categories.index') }}">Quản lí danh mục</a></li>
            <li><a href="{{ route('admin.users.index') }}">Danh sách người dùng</a></li>
            <li><a href="#">Quản lí đơn hàng</a></li>
            <li><a href="#">Tin nhắn</a></li>
        </ul>
    </div>

    <!-- MAIN -->
    <div class="main-content">

        <div class="admin-header">

            <div class="admin-title">
                <h2>Admin Dashboard</h2>
            </div>

            <div class="admin-user">
                <div class="user-info" id="userToggle">
                    <div class="avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="username">
                        {{ Auth::user()->name }}
                    </span>
                    <span class="arrow">▼</span>
                </div>

                <div class="dropdown-menu" id="userDropdown">

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Đăng xuất</button>
                    </form>
                </div>
            </div>

        </div>

        @yield('content')

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const toggle = document.getElementById("userToggle");
    const dropdown = document.getElementById("userDropdown");

    toggle.addEventListener("click", function (e) {
        e.stopPropagation();
        dropdown.classList.toggle("active");
    });

    document.addEventListener("click", function () {
        dropdown.classList.remove("active");
    });

});
</script>

</body>
</html>