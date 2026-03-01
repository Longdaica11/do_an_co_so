@extends('profile.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile/addresses.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<h3 class="address-title">Địa chỉ giao hàng</h3>

<a href="{{ route('profile.addresses.create') }}" class="btn-add">
    <i class="fa fa-plus"></i> Thêm địa chỉ
</a>

@foreach($addresses as $address)
<div class="address-box {{ $address->is_default ? 'default' : '' }}">

<div class="address-info">
    <p>
        <span class="label">Họ và tên:</span>
        {{ $address->recipient_name }}
        
        @if($address->is_default)
            <span class="badge-default">Mặc định</span>
        @endif
    </p>

    <p>
        <span class="label">Số điện thoại:</span>
        {{ $address->phone }}
    </p>

    <p>
        <span class="label">Địa chỉ:</span>
        {{ $address->address }},
        {{ $address->ward }},
        {{ $address->district }},
        {{ $address->city }}
    </p>
</div>

    <div class="address-actions">
        <a href="{{ route('profile.addresses.edit', $address->id) }}" class="btn-edit-sm">
            Sửa
        </a>

        <form action="{{ route('profile.addresses.destroy', $address->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete-sm">
                Xóa
            </button>
        </form>

        @if(!$address->is_default)
            <form action="{{ route('profile.addresses.setDefault', $address->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-default-sm">
                    Đặt mặc định
                </button>
            </form>
        @endif
    </div>

</div>
@endforeach

@if($addresses->isEmpty())
    <p>Chưa có địa chỉ giao hàng.</p>
@endif

@endsection