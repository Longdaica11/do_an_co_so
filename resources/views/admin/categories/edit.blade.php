@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/create-product.css') }}">

<div class="form-wrapper">
    <div class="form-box">
        <h2>Sửa danh mục</h2>

        <form action="{{ route('admin.categories.update', $category->id) }}" 
              method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tên danh mục</label>
                <input type="text" 
                       name="name" 
                       value="{{ $category->name }}" 
                       required>
            </div>

            <button type="submit" class="btn-submit">
                Cập nhật danh mục
            </button>

        </form>
    </div>
</div>

@endsection