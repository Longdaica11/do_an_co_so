<div class="navbar">
    <div class="nav-container">

        <!-- LEFT MENU -->
        <ul class="nav-menu">
            <li><a href="{{ route('home') }}">Trang chủ</a></li>
            <li><a href="#">Giới thiệu</a></li>
        </ul>

        <!-- RIGHT SIDE -->
        <div class="nav-right">
            
            <!-- CART -->
            <div class="cart-nav">

                <a href="{{ route('orders.my') }}" class="btn-order">
                    📦 Đơn hàng
                </a>

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
                <form action="{{ route('products.search') }}" method="GET" class="search-form">
                    <input type="text" name="keyword" 
                        placeholder="Tìm sản phẩm..."
                        value="{{ request('keyword') }}">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>

        </div>

    </div>
</div>