@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/categories/create.css') }}">

<div class="create-category-wrapper">
    <div class="create-category-box">
        <h2>Thêm danh mục</h2>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="create-category-group">
                <label>Tên danh mục</label>
                <input type="text" name="name" required>
            </div>

            <button type="submit" class="create-category-btn">
                Thêm danh mục
            </button>
        </form>
    </div>
</div>

@endsection