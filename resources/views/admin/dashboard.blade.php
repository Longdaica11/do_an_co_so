@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">

<div class="product-container">

    <div class="product-header">
        <h2>Danh sách sản phẩm</h2>

        <a href="{{ route('admin.products.create') }}" class="btn-add">
            + Thêm sản phẩm
        </a>
    </div>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá bán</th>
                <th>Thao tác</th>
            </tr>
        </thead>

        <tbody>
            @forelse($products as $key => $product)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? '' }}</td>
                    <td>{{ number_format($product->price) }} đ</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">
                            Sửa
                        </a>

                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                              method="POST"
                              style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete"
                                onclick="return confirm('Xóa sản phẩm?')">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Chưa có sản phẩm nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection