<div class="profile-right">

    <div class="profile-user-box">
        <div class="profile-menu-user">
            <i class="fa fa-user-circle"></i>
            <div>
                <div class="name">{{ Auth::user()->name }}</div>
                <div class="role">Khách hàng</div>
            </div>
        </div>
    </div>

    <div class="profile-menu-box">
        <ul class="profile-menu">
            <li>
                <a href="{{ route('profile.info') }}">
                    <i class="fa fa-user"></i>
                    Thông tin cá nhân
                </a>
            </li>

            <li>
                <a href="{{ route('profile.addresses') }}">
                    <i class="fa fa-map-marker-alt"></i>
                    Địa chỉ giao hàng
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-lock"></i>
                    Đổi mật khẩu
                </a>
            </li>
        </ul>
    </div>

</div>