<div class="navbar">
    <div class="nav-container">

        <!-- LEFT MENU -->
        <ul class="nav-menu">
            <li><a href="{{ route('home') }}">Trang chủ</a></li>
            <li><a href="#">Membership</a></li>
            <li><a href="#">Dụng cụ tập luyện</a></li>
            <li><a href="#">Giới thiệu</a></li>
        </ul>

        <!-- RIGHT SIDE -->
        <div class="nav-right">
            
            <!-- CART -->
            <div class="cart-nav">
                <a href="{{ route('cart.index') }}" class="cart-link">
                    🛒
                    <span>Giỏ hàng</span>

                    @if($cartCount > 0)
                        <span class="cart-count">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
            </div>

            <!-- SEARCH -->
            <div class="search-box">
                <input type="text" placeholder="Tìm kiếm...">
                <button>🔍</button>
            </div>

        </div>

    </div>
</div>