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

                <!-- ===== IMAGE SECTION ===== -->
                <div class="image-section">

                    <div class="image-preview-box">
                        <img id="preview-image"
                             src="{{ asset('storage/' . $product->image) }}"
                             alt="Ảnh sản phẩm">
                    </div>

                    <!-- input ẩn -->
                    <input type="file"
                           name="image"
                           id="imageUpload"
                           accept="image/*"
                           hidden
                           onchange="previewImage(event)">

                    <!-- nút upload -->
                    <label for="imageUpload" class="btn-upload">
                        Cập nhật ảnh
                    </label>

                </div>


                <!-- ===== FORM INFO ===== -->
                <div class="form-info">

                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text"
                               name="name"
                               value="{{ $product->name }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Giá bán</label>
                        <input type="number"
                               name="price"
                               value="{{ $product->price }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Danh mục</label>
                        <select name="category_id" required>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description">{{ $product->description }}</textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        Cập nhật sản phẩm
                    </button>

                </div>

            </div>

        </form>
    </div>
</div>


<script>
function previewImage(event) {
    const reader = new FileReader();

    reader.onload = function(){
        document.getElementById('preview-image').src = reader.result;
    }

    reader.readAsDataURL(event.target.files[0]);
}
</script>

@endsection