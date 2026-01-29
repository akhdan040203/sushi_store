<x-store-layout title="Home - SushiYup V5 Zen Edition">
@push('styles')
    @vite('resources/css/homepage-v5.css')
@endpush

<div class="home-v5">
    <!-- Hero Zen Section -->
    <section class="v5-hero">
        <div class="v5-hero-grid">
            <div class="v5-hero-text">
                <h1>The Purity<br>of Japanese<br>Flavor.</h1>
                <p>Experience the art of authentic sushi, where every piece is a masterpiece of precision and freshness.</p>
                <a href="/items" class="v5-btn-minimal">Discover Menu</a>
            </div>
            <div class="v5-hero-img">
                <img src="{{ asset('images/v5/hero2.png') }}" alt="Artisanal Sushi">
            </div>
        </div>
    </section>

    <!-- Best Seller Section -->
    <section class="v5-section">
        <div class="v5-section-header">
            <p>Chef's Recommendation</p>
            <h2>Recommendation Selection</h2>
        </div>
        
        <div class="v5-slider-container">
            <button class="v5-slider-nav prev" onclick="scrollSlider(-1)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
            
            <div class="v5-product-slider" id="productSlider">
                @foreach($featuredProducts as $product)
                <div class="v5-card">
                    <div class="v5-card-img-wrapper">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    </div>
                    <div class="v5-card-content">
                        <h3>{{ $product->name }}</h3>
                        <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <a href="javascript:void(0)" class="add-link" onclick="Livewire.dispatch('addToCart', { productId: {{ $product->id }}, quantity: 1 })">ADD TO CART</a>
                    </div>
                </div>
                @endforeach
            </div>

            <button class="v5-slider-nav next" onclick="scrollSlider(1)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
        </div>
    </section>
    <!-- Combo Spread Split -->
    <section class="v5-split">
        <div class="v5-split-img">
            <img src="{{ asset('images/v5/combo.png') }}" alt="Nigiri Platter">
        </div>
        <div class="v5-split-content" style="background: #fdfdfd;">
            <h2 style="text-transform: uppercase;">The Salmon Trio,<br>Redefined.</h2>
            <p>Our salmon combo features a curated selection of the finest Alaskan salmon, sliced with surgical precision to ensure the perfect texture and fat distribution in every bite. Every piece of fish is handpicked daily from the morning market, ensuring a level of freshness that speaks for itself.</p>
            <div style="margin-top: 3rem;">
                <a href="{{ route('product.show', 'salmon-nigiri') }}" class="v5-btn-minimal">ORDER NOW</a>
            </div>
        </div>
    </section>

    <!-- Modern Philosophy -->
    <section class="v5-split v5-split-reverse-mobile">
        <div class="v5-split-content" style="background: #fff;">
            <h2 style="text-transform: uppercase;">Modern AsianSoul.</h2>
            <p>We blend ancient traditions with contemporary urban lifestyle. Our dining space is a sanctuary of minimalist design, providing a peaceful backdrop for your gastronomic journey. Inspired by the principles of Zen, we believe that the environment is just as important as the food itself.</p>
            <div style="margin-top: 3rem;">
                <a href="/service" class="v5-btn-minimal">OUR STORY</a>
            </div>
        </div>
        <div class="v5-split-img">
            <img src="{{ asset('images/v5/modern_asian.png') }}" alt="Sushi Atmosphere">
        </div>
    </section>

    <!-- Reservation Section -->
    <section class="v5-reserve">
        <div class="v5-reserve-inner">
            <p style="letter-spacing: 5px; color: var(--v5-zen-accent); margin-bottom: 2rem;">PROMOTION & RESERVATION</p>
            <h2>Experience an Unforgettable Culinary Journey.</h2>
            <p>Get exclusive offers for group bookings or romantic dinners. We ensure every visit is a special moment with world-class service and the freshest ingredients from the finest fish markets. Book now to secure your spot and don't miss out on our seasonal specialties.</p>
            <div style="margin-top: 4rem;">
                <a href="https://wa.me/" class="v4-btn-primary" style="background: #fff; color: #000; padding: 1.5rem 4rem;">RESERVATION</a>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    @vite('resources/js/homepage.js')
@endpush

    
</x-store-layout>
