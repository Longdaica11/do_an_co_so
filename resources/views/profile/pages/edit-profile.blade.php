<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa trang cá nhân</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/topbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile/logo-left.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile/menu-profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile/edit-profile.css') }}">

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

@include('partials.topbar')
@include('profile.logo-left')

<h2 class="profile-page-title">Chỉnh sửa thông tin cá nhân</h2>

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="profile-wrapper">

        {{-- LEFT: AVATAR --}}
        <div class="profile-left">

            <div class="avatar-box">
                <img id="avatarPreview"
                     src="{{ $user->avatar 
                        ? asset('storage/avatars/' . $user->avatar) 
                        : asset('images/default-avatar.png') }}"
                     alt="Avatar">
            </div>

            <p class="text-avt">Ảnh đại diện</p>

            <!-- INPUT FILE ẨN (NẰM TRONG FORM) -->
            <input type="file"
                   id="avatarInput"
                   name="avatar"
                   accept="image/*"
                   hidden>

            <!-- BUTTON CHỌN ẢNH -->
            <button type="button"
                    class="btn-change-avatar"
                    onclick="document.getElementById('avatarInput').click();">
                Thay đổi ảnh
            </button>

        </div>

        {{-- RIGHT: THÔNG TIN --}}
        <div class="profile-center">
            <div class="form-group">
                <label>Email</label>
                <input type="email"
                    name="email"
                    value="{{ $user->email }}"
                    required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Họ và tên</label>
                <input type="text"
                       name="name"
                       value="{{ $user->name }}"
                       required>
            </div>

            <div class="form-group">
                <label>Giới tính</label>

                <div class="gender-group">

                    <label class="gender-option">
                        <input type="radio" name="gender" value="Nam"
                            {{ $user->gender == 'Nam' ? 'checked' : '' }}>
                        <span class="radio-custom"></span>
                        Nam
                    </label>

                    <label class="gender-option">
                        <input type="radio" name="gender" value="Nữ"
                            {{ $user->gender == 'Nữ' ? 'checked' : '' }}>
                        <span class="radio-custom"></span>
                        Nữ
                    </label>

                </div>
            </div>

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone" 
                    value="{{ old('phone', $user->phone) }}" 
                    class="form-control">
                @error('phone')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn-save">
                Lưu thay đổi
            </button>

        </div>

    </div>

</form>

{{-- SCRIPT PREVIEW ẢNH --}}
<script>
document.getElementById("avatarInput").addEventListener("change", function(event) {

    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById("avatarPreview").src = e.target.result;
        };

        reader.readAsDataURL(file);
    }

});
</script>

</body>
</html>