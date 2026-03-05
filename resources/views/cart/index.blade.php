@extends('layouts.app')

@section('content')

@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile/logo-left.css') }}">

<div class="cart-page">

@if($cartItems->count() > 0)

    <!-- FORM CHÍNH (XÓA + CHECKOUT CHUNG 1 FORM) -->
    <form id="cart-form" method="POST">
        @csrf

        <div class="cart-header">
            <h2>Giỏ hàng của bạn</h2>

            <!-- NÚT XOÁ -->
            <button type="submit"
                    formaction="{{ route('cart.deleteSelected') }}"
                    formmethod="POST"
                    onclick="this.form._method.value='DELETE'"
                    class="delete-selected-btn">
                Xóa
            </button>
        </div>

        <!-- hidden method cho delete -->
        <input type="hidden" name="_method" value="POST">

        <table class="cart-table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="check-all"></th>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                </tr>
            </thead>

            <tbody>
                @foreach($cartItems as $item)
                    @php 
                        $subtotal = $item->product->price * $item->quantity;
                    @endphp

                    <tr>
                        <td>
                            <input type="checkbox"
                                   name="selected_items[]"
                                   value="{{ $item->id }}"
                                   class="product-check"
                                   data-price="{{ $item->product->price }}"
                                   data-quantity="{{ $item->quantity }}">
                        </td>

                        <td>
                            <img src="{{ asset('storage/'.$item->product->image) }}" width="70">
                        </td>

                        <td>{{ $item->product->name }}</td>

                        <td>{{ number_format($item->product->price) }} đ</td>

                        <td>{{ $item->quantity }}</td>

                        <td>{{ number_format($subtotal) }} đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="cart-summary">
            <h3>
                Tổng tiền:
                <span id="total-price">0</span> đ
            </h3>

            <!-- NÚT CHECKOUT -->
            <button type="submit"
                    formaction="{{ route('checkout.go') }}"
                    class="btn-checkout">
                Đặt hàng
            </button>
        </div>

    </form>

@else
    <div class="cart-header">
        <h2>Giỏ hàng của bạn</h2>
    </div>
    <p>Giỏ hàng đang trống.</p>
@endif

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const checkboxes = document.querySelectorAll('.product-check');
    const totalDisplay = document.getElementById('total-price');
    const checkAll = document.getElementById('check-all');

    function calculateTotal() {
        let total = 0;

        checkboxes.forEach(cb => {
            if (cb.checked) {
                const price = parseFloat(cb.dataset.price) || 0;
                const quantity = parseInt(cb.dataset.quantity) || 0;
                total += price * quantity;
            }
        });

        if (totalDisplay) {
            totalDisplay.innerText = total.toLocaleString('vi-VN');
        }
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            calculateTotal();

            if (!this.checked && checkAll) {
                checkAll.checked = false;
            }

            if (checkAll) {
                const allChecked = Array.from(checkboxes).every(c => c.checked);
                checkAll.checked = allChecked;
            }
        });
    });

    if (checkAll) {
        checkAll.addEventListener('change', function () {
            checkboxes.forEach(cb => {
                cb.checked = this.checked;
            });
            calculateTotal();
        });
    }

    calculateTotal();
});
</script>

@endsection