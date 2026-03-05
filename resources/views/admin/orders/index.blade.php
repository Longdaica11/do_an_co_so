@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/order.css') }}">

<div class="admin-orders">

    <div class="product-header">
        <h2>Danh sách đơn hàng</h2>
    </div>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->user->name ?? 'N/A' }}</td>
                <td>{{ number_format($order->total_price) }} đ</td>
                <td>
                    @if($order->status == 'pending')
                        <span class="pending">Chờ xử lý</span>
                    @else
                        <span class="confirmed">Đã xác nhận</span>
                    @endif
                </td>
                <td>
                    @if($order->status == 'pending')
                        <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST">
                            @csrf
                            <button class="btn-confirm">Xác nhận</button>
                        </form>
                    @else
                        —
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection