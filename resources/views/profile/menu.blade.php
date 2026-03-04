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
                <a href="{{ route('profile.change-password') }}">
                    <i class="fa fa-lock"></i>
                    Đổi mật khẩu
                </a>
            </li>

            <li class="logout-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fa fa-sign-out-alt"></i>
                        Đăng xuất
                    </button>
                </form>
            </li>

        </ul>
    </div>

</div>