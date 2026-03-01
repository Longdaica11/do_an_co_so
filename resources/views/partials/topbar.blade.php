<div class="topbar">
    <div class="topbar-left">
        <span>
            <i class="fa fa-phone"></i>
            Hotline: 0123456789
        </span>
        <span>
            <i class="fa fa-envelope"></i>
            Mail: ntlongwork@gmail.com
        </span>
    </div>

    <div class="topbar-right">
        @guest
            <a href="{{ route('login') }}">
                <i class="fa fa-user"></i>
                Đăng nhập
            </a>

            <a href="{{ route('register') }}">
                <i class="fa fa-user-plus"></i>
                Đăng ký
            </a>
        @else
            <a href="{{ route('profile.info') }}" class="username">
                <i class="fa fa-user-circle"></i>
                {{ Auth::user()->name }}
            </a>
        @endguest
    </div>
</div>
