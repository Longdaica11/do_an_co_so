@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/create-product.css') }}">

<div class="form-wrapper">
    <div class="form-box">
        <h2>Thêm sản phẩm</h2>

        <form action="{{ route('admin.products.store') }}" 
              method="POST" 
              enctype="multipart/form-data">
            @csrf

            <div class="form-flex">

                <!-- ================= LEFT: IMAGE ================= -->
                <div class="image-upload-wrapper">

                    <div class="image-preview-box">
                        <img id="preview-image" src="#" alt="Preview">
                    </div>

                    <input type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        hidden
                        onchange="previewImage(event)">

                    <button type="button"
                            class="btn-upload"
                            onclick="document.getElementById('image').click()">
                        Thêm ảnh
                    </button>

                </div>

                <!-- ================= RIGHT: INFO ================= -->
                <div class="form-info">

                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Giá</label>
                        <input type="number" name="price" required>
                    </div>

                    <div class="form-group">
                        <label>Danh mục</label>
                        <select name="category_id" required>
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description"></textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        Thêm sản phẩm
                    </button>

                </div>

            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {

const file = event.target.files[0];
const preview = document.getElementById("preview-image");

if(file){
    const reader = new FileReader();

    reader.onload = function(e){
        preview.src = e.target.result;
        preview.style.display = "block";
    }

    reader.readAsDataURL(file);
}

}
</script>

@endsection