@extends('layouts.app')

@section('content')

@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('css/check-out.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

<div class="checkout-wrapper">

    {{-- ĐỊA CHỈ --}}
    <div class="checkout-address">

        <div class="address-header">
            <h3>Địa chỉ nhận hàng</h3>

            <button type="button" class="btn-change" onclick="toggleAddressList()">
                Đổi
            </button>
        </div>

        @if($defaultAddress)
            <div class="address-info">
                <div class="address-top">
                    <span class="address-name">
                        {{ $defaultAddress->recipient_name }}
                    </span>
                    <span class="address-phone">
                        | {{ $defaultAddress->phone }}
                    </span>
                </div>

                <div class="address-detail">
                    {{ $defaultAddress->full_address }}
                </div>
            </div>
        @endif

        {{-- DANH SÁCH ĐỊA CHỈ --}}
        <div id="address-list" class="address-list" style="display:none;">
            @foreach($addresses as $address)
                <form method="POST"
                    action="{{ route('checkout.changeAddress', $address->id) }}">
                    @csrf

                    <button class="address-item">
                        <strong>{{ $address->recipient_name }}</strong>
                        | {{ $address->phone }}
                        <br>
                        {{ $address->full_address }}
                    </button>
                </form>
            @endforeach
        </div>

    </div>

    {{-- DANH SÁCH SẢN PHẨM --}}
    <div class="checkout-products">
        @php $total = 0; @endphp

        @foreach($cartItems as $item)
            @php
                $subtotal = $item->product->price * $item->quantity;
                $total += $subtotal;
            @endphp

            <div class="checkout-item">
                <img src="{{ asset('storage/'.$item->product->image) }}">

                <div class="item-info">
                    <p class="item-name">{{ $item->product->name }}</p>
                    <p>Giá: {{ number_format($item->product->price) }} đ</p>
                    <p>Số lượng: {{ $item->quantity }}</p>
                </div>

                <div class="item-total">
                    {{ number_format($subtotal) }} đ
                </div>
            </div>
        @endforeach
    </div>

    {{-- TỔNG TIỀN --}}
    <div class="checkout-footer">
        <h3>Tổng tiền: {{ number_format($total) }} đ</h3>

        <button class="btn-order">
            Đặt hàng
        </button>
    </div>

</div>

<script>
function toggleAddressList() {
    const list = document.getElementById('address-list');
    list.style.display = list.style.display === 'none' ? 'block' : 'none';
}
</script>

@endsection