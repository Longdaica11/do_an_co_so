<a href="{{ route('product.show', $product->id) }}" class="product-card">

    <img src="{{ asset('storage/' . $product->image) }}" 
         class="product-image">

    <div class="product-card-content">
        <div class="product-name">
            {{ $product->name }}
        </div>

        <div class="product-price">
            {{ number_format($product->price, 0, ',', '.') }} ₫
        </div>
    </div>

</a>