@extends('layouts.app')

@section('content')

@foreach($categories as $category)

    <div class="category-section">
        <h2>{{ $category->name }}</h2>

        <div class="product-grid">
            @foreach($category->products as $product)
                <div class="product-card">
                    <img src="{{ asset('storage/' . $product->image) }}">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ number_format($product->price) }} đ</p>
                </div>
            @endforeach
        </div>
    </div>

@endforeach

@endsection