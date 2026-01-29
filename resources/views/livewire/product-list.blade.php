@push('styles')
    @vite('resources/css/products.css')
@endpush

<div class="items-page">
    <div class="items-header">
        <h1>OUR MENU</h1>
        <p>Explore our wide range of authentic Japanese delicacies</p>
    </div>

    <div class="items-layout">
        <!-- Sidebar Filters (Desktop Only) -->
        <aside class="filters-sidebar">
            <div class="filter-section">
                <h3>Categories</h3>
                <ul class="category-list">
                    <li class="category-item">
                        <a wire:click="selectCategory(null)" class="category-link {{ is_null($selectedCategory) ? 'active' : '' }}">
                            <span>All Items</span>
                            <span class="count-badge">{{ \App\Models\Product::count() }}</span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                    <li class="category-item">
                        <a wire:click="selectCategory({{ $category->id }})" class="category-link {{ $selectedCategory == $category->id ? 'active' : '' }}">
                            <span style="display: flex; align-items: center; gap: 0.5rem;"><x-category-icon :slug="$category->slug" size="18" /> {{ $category->name }}</span>
                            <span class="count-badge">{{ $category->products_count }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="items-main">
            <!-- Mobile Category Filter -->
            <div class="mobile-filter-container">
                <select class="mobile-filter-select" wire:model.live="selectedCategory">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->products_count }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Toolbar -->
            <div class="items-toolbar">
                <div class="search-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search for your favorite sushi...">
                </div>

                <div class="sort-box">
                    <select wire:model.live="sort">
                        <option value="latest">Newest First</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="rating">Top Rated</option>
                    </select>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="products-grid">
                @forelse($products as $index => $product)
                <div class="product-card" wire:key="product-{{ $product->id }}">
                    <div class="product-image">
                        <a href="/product/{{ $product->slug }}" wire:navigate>
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        </a>
                        @if($product->has_discount)
                        <span class="product-tag">-{{ $product->discount_percentage }}%</span>
                        @endif
                    </div>
                    <div class="product-content">
                        <h3><a href="/product/{{ $product->slug }}" wire:navigate>{{ $product->name }}</a></h3>
                        <div class="product-footer">
                            <span class="product-price">Rp {{ number_format($product->effective_price, 0, ',', '.') }}</span>
                            <div class="add-to-cart-wrapper">
                                @livewire('add-to-cart-button', ['productId' => $product->id, 'showText' => false], key('plist-'.$product->id))
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="no-results">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="8" y1="8" x2="14" y2="14"/><line x1="14" y1="8" x2="8" y2="14"/>
                    </svg>
                    <h3>No items found</h3>
                    <p>Try adjusting your search or filters to find what you're looking for.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                {{ $products->links() }}
            </div>
        </main>
    </div>
</div>
