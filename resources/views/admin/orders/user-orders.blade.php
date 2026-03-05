@extends('layouts.app')

@section('content')

@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile/logo-left.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/user-orders.css') }}">

<div class="my-orders-container">

    <h2>Đơn hàng của tôi</h2>

    @if($orders->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ number_format($order->total) }} đ</td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="pending">🟡 Chờ xác nhận</span>
                        @else
                            <span class="confirmed">🟢 Đã xác nhận</span>
                        @endif
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Bạn chưa có đơn hàng nào.</p>
    @endif

</div>

@endsection