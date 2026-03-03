@extends('profile.layout')

<link rel="stylesheet" href="{{ asset('css/profile/change-password.css') }}">

@section('content')
<div class="change-password-container">
    <h2>Đổi mật khẩu</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update-password') }}">
        @csrf

        <div class="form-group">
            <label>Mật khẩu hiện tại</label>
            <input type="password" name="current_password" required>
        </div>

        <div class="form-group">
            <label>Mật khẩu mới</label>
            <input type="password" name="new_password" required>
        </div>

        <div class="form-group">
            <label>Xác nhận mật khẩu mới</label>
            <input type="password" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="btn-submit">
            Cập nhật mật khẩu
        </button>
    </form>
</div>
@endsection