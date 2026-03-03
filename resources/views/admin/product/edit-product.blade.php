@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/edit-product.css') }}">
@endpush

@section('content')

<div class="form-wrapper">
    <div class="form-box">
        <h2>Sửa sản phẩm</h2>

        <form action="{{ route('admin.products.update', $product->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-flex">

                <!-- Ảnh -->
                <div class="image-preview-box">
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="Ảnh sản phẩm">

                    <input type="file" name="image" class="btn-upload">
                </div>

                <!-- Thông tin -->
                <div class="form-info">

                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="name"
                               value="{{ $product->name }}">
                    </div>

                    <div class="form-group">
                        <label>Giá bán</label>
                        <input type="number" name="price"
                               value="{{ $product->price }}">
                    </div>

                    <div class="form-group">
                        <label>Danh mục</label>
                        <select name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn-submit">
                        Cập nhật sản phẩm
                    </button>

                </div>

            </div>

        </form>
    </div>
</div>

@endsection