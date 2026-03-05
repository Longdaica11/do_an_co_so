<a href="{{ route('products.show', $product->id) }}" class="product-card">

    <img src="{{ asset('storage/' . $product->image) }}" 
         alt="{{ $product->name }}" 
         class="product-image">

    <div class="product-card-content">
        <div class="product-name">
            {{ $product->name }}
        </div>

        <div class="product-price">
            {{ number_format($product->price) }} VNĐ
        </div>
    </div>

</a>