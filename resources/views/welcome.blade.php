<x-store-layout title="Home - Sushi Ecommerce">
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Discover the Ultimate Sushi Experience</h1>
            <p>Pure Sushi Experience<br>Focusing on Premium Quality Ingredients</p>
            <div class="hero-buttons">
                <a href="/items" class="btn btn-outline">Check menu</a>
                <a href="/items" class="btn btn-primary">
                    Order now 
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            </div>
        </div>
        
        <div class="hero-images">
            <div class="hero-img hero-img-1">
                <img src="/images/products/sushi_platter.png" alt="Sushi Platter">
            </div>
            <div class="hero-img hero-img-2">
                <img src="/images/products/hero_sushi.png" alt="Nigiri Sushi">
                <div class="arrow-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="7" y1="17" x2="17" y2="7"/>
                        <polyline points="7 7 17 7 17 17"/>
                    </svg>
                </div>
                <div class="hero-img-overlay">
                    <p>FEEL THE TASTE OF JAPANESE FOOD</p>
                </div>
            </div>
            <div class="hero-img hero-img-3">
                <img src="/images/products/salmon_nigiri.png" alt="Salmon Sushi">
            </div>
            <div class="hero-img hero-img-4">
                <img src="/images/products/tuna_sashimi.png" alt="Tuna Sashimi">
            </div>
        </div>
    </section>
    
    <!-- Popular Dishes Section -->
    <section class="popular-dishes">
        <div class="section-title">
            <h2>POPULAR DISHES</h2>
        </div>
        
        <div class="dishes-grid">
            @foreach($featuredProducts as $product)
            <div class="dish-card">
                <a href="/product/{{ $product->slug }}" class="dish-image">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    <span class="dish-rating">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                        {{ $product->rating }}
                    </span>
                </a>
                <div class="dish-info">
                    <div>
                        <h3><a href="/product/{{ $product->slug }}">{{ $product->name }}</a></h3>
                        <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    @livewire('add-to-cart-button', ['productId' => $product->id, 'showText' => false], key('dish-'.$product->id))
                </div>
            </div>
            @endforeach
        </div>
    </section>
    
    <!-- Healthy Food Section -->
    <section class="healthy-food-banner" id="about" style="background-image: url('{{ asset('images/products/chef_cooking.png') }}')">
        <div class="healthy-food-overlay">
            <div class="healthy-food-banner-content">
                <h2 class="font-playfair"><em>We provide</em><br><strong>Healthy Food</strong></h2>
                <p>Food from us comes from our relatives, whether they have wings or fines or roots. That is how we consider food. Food has a cultural, It has a story, It has a relationship. Our sushi is made with the freshest ingredients, carefully selected by our expert chefs who have decades of experience in Japanese cuisine.</p>
            </div>
        </div>
    </section>
    
    <!-- Menu Section -->
    <section class="menu-section" id="menu">
        <div class="section-title">
            <h2>M E N U</h2>
        </div>
        
        <div class="menu-categories">
            @foreach($categories as $category)
            <button class="category-btn {{ $loop->first ? 'active' : '' }}">
                <span style="font-size: 1.2rem;">{{ $category->icon }}</span>
                {{ $category->name }}
            </button>
            @endforeach
        </div>
        
        <h3 class="category-title">SUSHI</h3>
        
        <div class="menu-grid">
            @foreach($menuProducts as $product)
            <a href="/product/{{ $product->slug }}" class="menu-card">
                <div class="menu-card-image">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                </div>
                <div class="menu-card-info">
                    <div>
                        <h4>{{ $product->name }}</h4>
                        <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <span class="menu-card-btn" 
                        @if(!(auth()->check() && auth()->user()->isAdmin()))
                        onclick="event.preventDefault(); event.stopPropagation(); Livewire.dispatch('addToCart', { productId: {{ $product->id }}, quantity: 1 })"
                        @else
                        style="opacity: 0.5; cursor: not-allowed;"
                        title="Admin tidak dapat memesan"
                        @endif
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 6h15l-1.5 9h-12z"/>
                            <circle cx="9" cy="20" r="1"/>
                            <circle cx="18" cy="20" r="1"/>
                        </svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
        
        <a href="/items" class="show-more-btn" style="text-decoration: none; display: inline-block; text-align: center;">SHOW MORE</a>
    </section>
    
    <!-- Newsletter Section -->
    <section class="newsletter">
        <h3>Receive unique promotions<br>and coupons emails</h3>
        <form class="newsletter-form">
            <input type="email" placeholder="your@gmail.com">
            <button type="submit">SUBSCRIBE</button>
        </form>
    </section>
</x-store-layout>
