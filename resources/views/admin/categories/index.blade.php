@extends('layouts.admin')

@section('content')

<div class="product-container">

    <div class="product-header">
        <h2>Danh sách danh mục</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn-add">
            + Thêm danh mục
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
                <th>Tên danh mục</th>
                <th>Số sản phẩm</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $key => $category)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->products->count() }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-edit">Sửa</a>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                              method="POST" 
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete"
                                onclick="return confirm('Bạn có chắc muốn xóa?')">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Không có danh mục</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection