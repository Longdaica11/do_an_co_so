@extends('layouts.app')

@section('content')

@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/product-show.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile/logo-left.css') }}">

<div class="product-page">

    @if(session('success'))
        <div class="alert-success" id="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="product-box">

        <!-- LEFT -->
        <div class="product-image-section">
            <img src="{{ asset('storage/' . $product->image) }}" 
                 alt="{{ $product->name }}">
        </div>

        <!-- RIGHT -->
        <div class="product-info-section">

            <h1 class="product-name">
                {{ $product->name }}
            </h1>

            <div class="product-price">
                {{ number_format($product->price) }} đ
            </div>

            <div class="product-desc">
                {{ $product->description }}
            </div>

            <div class="quantity-box">
                <label>Số lượng:</label>
                <input type="number" value="1" min="1">
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-add-cart">
                    Thêm vào giỏ hàng
                </button>
            </form>

        </div>

    </div>

</div>

<script>
    setTimeout(function() {
        let msg = document.getElementById('success-message');
        if (msg) {
            msg.style.transition = "opacity 0.5s";
            msg.style.opacity = "0";
            setTimeout(() => msg.remove(), 500);
        }
    }, 3000);
</script>

@endsection