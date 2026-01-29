<div class="product-detail-page">
    
    <div class="product-detail-container">
        <!-- Product Image -->
        <div class="product-image-section">
            <div class="product-main-image">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                @if($product->has_discount)
                    <span class="discount-badge">-{{ $product->discount_percentage }}%</span>
                @endif
            </div>
        </div>

        <!-- Product Info -->
        <div class="product-info-section">
            <h1 class="product-title">{{ $product->name }}</h1>
            
            <div class="product-rating">
                @for($i = 1; $i <= 5; $i++)
                    <svg viewBox="0 0 24 24" fill="{{ $i <= $product->rating ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" class="{{ $i <= $product->rating ? 'star-filled' : 'star-empty' }}">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                @endfor
                <span>({{ $product->rating_count }} reviews)</span>
            </div>

            <div class="product-price-section">
                @if($product->has_discount)
                    <span class="original-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                @endif
                <span class="current-price">Rp {{ number_format($product->effective_price, 0, ',', '.') }}</span>
            </div>

            <p class="product-description">
                {{ $product->description ?? 'Premium sushi made from high-quality fresh ingredients, prepared by experienced chefs using traditional Japanese techniques.' }}
            </p>

            <div class="product-stock">
                @if($product->in_stock)
                    <span class="in-stock">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        Available ({{ $product->stock }} pcs)
                    </span>
                @else
                    <span class="out-of-stock">Out of Stock</span>
                @endif
            </div>

            @if($product->in_stock)
                <div class="quantity-section">
                    <label>Quantity:</label>
                    <div class="quantity-selector">
                        <button wire:click="decrementQuantity" class="qty-btn" {{ $quantity <= 1 ? 'disabled' : '' }}>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </button>
                        <span class="qty-value">{{ $quantity }}</span>
                        <button wire:click="incrementQuantity" class="qty-btn" {{ $quantity >= $product->stock ? 'disabled' : '' }}>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="product-actions" style="margin-top: 2rem;">
                    <button wire:click="addToCart" class="add-cart-btn-text"
                        @if(auth()->check() && auth()->user()->isAdmin())
                        disabled
                        style="opacity: 0.5; cursor: not-allowed;"
                        title="Admins cannot place orders"
                        @endif
                    >
                        ADD TO CART
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Related Products -->
    @if(count($relatedProducts) > 0)
        <section class="related-products">
            <h2>Related Products</h2>
            <div class="related-grid">
                @foreach($relatedProducts as $relatedProduct)
                    <a href="/product/{{ $relatedProduct->slug }}" class="related-card" wire:navigate>
                        <div class="related-image">
                            <img src="{{ $relatedProduct->image_url }}" alt="{{ $relatedProduct->name }}">
                        </div>
                        <div class="related-info">
                            <h4>{{ $relatedProduct->name }}</h4>
                            <span class="price">Rp {{ number_format($relatedProduct->effective_price, 0, ',', '.') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
