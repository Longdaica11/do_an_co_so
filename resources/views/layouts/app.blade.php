<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Trang chủ')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS từng phần -->
    <link rel="stylesheet" href="{{ asset('css/topbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header-info.css') }}">

    {{-- CSS chung (nếu có) --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
         <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>

    {{-- TOPBAR --}}
    @include('partials.topbar')

    {{-- HEADER INFO (3 ảnh dưới topbar) --}}
    @include('partials.header-info')

    {{-- NỘI DUNG TRANG --}}
    <main class="content">
        @yield('content')
    </main>

</body>
</html>
