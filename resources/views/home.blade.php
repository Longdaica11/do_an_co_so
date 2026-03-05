@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/product-card.css') }}">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

@include('partials.navbar')

{{-- ===== PHẦN TRÊN: BANNER + SIDEBAR ===== --}}
<div class="home-wrapper">

    {{-- MAIN - TRÁI --}}
    <div class="home-main">

        <div class="top-banners">
            <img src="{{ asset('images/image 69.png') }}">
            <img src="{{ asset('images/image 70.png') }}">
            <img src="{{ asset('images/image 68.png') }}">
        </div>

        <div class="bottom-banner">
            <img src="{{ asset('images/image 71.png') }}">
        </div>

    </div>

    {{-- SIDEBAR --}}
    <div class="home-sidebar">
        <div class="sidebar-title">
            Danh mục sản phẩm
        </div>

        <ul class="sidebar-list">
            @foreach($categories as $category)
                @if($category->products->count() > 0)
                    <li>
                        <a href="{{ route('category.show', $category->id) }}"
                           class="category-link 
                           {{ isset($currentCategory) && $currentCategory->id == $category->id ? 'active-category' : '' }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

</div>

{{-- ===== PHẦN DƯỚI: PRODUCT ===== --}}
<div class="product-wrapper">

    <div class="product-section">

        {{-- 🎯 TIÊU ĐỀ --}}
        <h2 class="section-title">
            @if(request('keyword'))
                Kết quả tìm kiếm cho: "{{ request('keyword') }}"
            @elseif(isset($currentCategory))
                {{ $currentCategory->name }}
            @else
                Tất cả sản phẩm
            @endif
        </h2>

        {{-- 🎯 GRID --}}
        <div class="product-grid">
            @forelse($products as $product)
                <x-product-card :product="$product"/>
            @empty
                <p>Không có sản phẩm nào.</p>
            @endforelse
        </div>

        {{-- 🎯 PAGINATION --}}
        @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="pagination-wrapper mt-4 d-flex justify-content-center">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @endif

        @isset($categories)
            @foreach($categories as $category)
                ...
            @endforeach
        @endisset

    </div>

</div>

@endsection