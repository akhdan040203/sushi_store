<div class="items-page">
    <style>
        .items-page {
            background: var(--soft-cream);
            min-height: 100vh;
            padding: 4rem 5% 6rem;
        }

        .items-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .items-header h1 {
            font-family: 'Cinzel', serif;
            font-size: 3rem;
            color: var(--dark-charcoal);
            margin-bottom: 1rem;
        }

        .items-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 3rem;
        }

        /* Sidebar Filters - Desktop Only */
        .filters-sidebar {
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .filter-section {
            background: white;
            padding: 1.5rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .filter-section h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
            color: var(--dark-charcoal);
            border-bottom: 2px solid var(--soft-cream);
            padding-bottom: 0.5rem;
        }

        .category-list {
            list-style: none;
            padding: 0;
        }

        .category-item {
            margin-bottom: 0.5rem;
        }

        .category-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            color: var(--dark-charcoal);
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .category-link:hover {
            background: var(--soft-cream);
            color: var(--accent-red);
        }

        .category-link.active {
            background: var(--dark-charcoal);
            color: white;
        }

        .count-badge {
            font-size: 0.8rem;
            padding: 0.2rem 0.6rem;
            background: rgba(0,0,0,0.05);
            border-radius: 20px;
        }

        .active .count-badge {
            background: rgba(255,255,255,0.2);
        }

        /* Mobile Mobile Filter Dropdown */
        .mobile-filter-container {
            display: none;
            margin-bottom: 2rem;
        }

        .mobile-filter-select {
            width: 100%;
            padding: 1.2rem;
            border-radius: 20px;
            border: 1px solid #eee;
            background: white;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            color: var(--dark-charcoal);
            outline: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1.5rem center;
            background-size: 1.2rem;
        }

        /* Search & Sort Bar */
        .items-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            flex-wrap: wrap;
            gap: 1rem;
        }

        .search-box {
            position: relative;
            flex: 1;
            min-width: 250px;
        }

        .search-box input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 1px solid #eee;
            border-radius: 15px;
            font-family: inherit;
            outline: none;
            transition: border-color 0.3s;
        }

        .search-box input:focus {
            border-color: var(--accent-red);
        }

        .search-box svg {
            position: absolute;
            left: 1.1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: #999;
        }

        .sort-box select {
            padding: 0.75rem 1.5rem;
            border: 1px solid #eee;
            border-radius: 15px;
            outline: none;
            cursor: pointer;
            background: white;
            font-family: inherit;
        }

        /* Products Grid with Dark Cards */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: var(--dark-charcoal); /* Black background like popular dishes */
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .product-image {
            height: 240px;
            position: relative;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.33, 1, 0.68, 1);
        }

        .product-card:hover .product-image img {
            transform: scale(1.12);
        }

        .product-tag {
            position: absolute;
            top: 1.25rem;
            left: 1.25rem;
            background: var(--accent-red);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            z-index: 2;
        }

        .product-content {
            padding: 1.5rem;
        }

        .product-content h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .product-content h3 a {
            color: white; /* White text for contrast on black card */
            text-decoration: none;
            transition: color 0.3s;
        }

        .product-content h3 a:hover {
            color: var(--vibrant-orange);
        }

        .product-rating {
            display: flex;
            gap: 0.3rem;
            margin-bottom: 1rem;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
        }

        .product-price {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--vibrant-orange);
        }

        .no-results {
            text-align: center;
            padding: 5rem 0;
            grid-column: 1 / -1;
            color: #777;
        }

        .no-results svg {
            width: 80px;
            height: 80px;
            color: #ddd;
            margin-bottom: 1rem;
        }

        /* Pagination */
        .pagination-container {
            margin-top: 5rem;
        }

        @media (max-width: 992px) {
            .items-layout {
                grid-template-columns: 1fr;
            }
            .filters-sidebar {
                display: none; /* Hide vertical filters on mobile */
            }
            .mobile-filter-container {
                display: block; /* Show select dropdown on mobile */
            }
            .items-header h1 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 576px) {
            .items-toolbar {
                flex-direction: column;
                align-items: stretch;
            }
            .products-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="items-header">
        <h1 class="font-cinzel">OUR MENU</h1>
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
                            <span>{{ $category->icon }} {{ $category->name }}</span>
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
                    <option value="{{ $category->id }}">{{ $category->icon }} {{ $category->name }} ({{ $category->products_count }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Toolbar -->
            <div class="items-toolbar">
                <div class="search-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                @forelse($products as $product)
                <div class="product-card" wire:key="product-{{ $product->id }}">
                    <div class="product-image">
                        <a href="/product/{{ $product->slug }}" wire:navigate>
                            <img src="{{ asset($product->image ?? 'images/placeholder.png') }}" alt="{{ $product->name }}">
                        </a>
                        @if($product->has_discount)
                        <span class="product-tag">-{{ $product->discount_percentage }}%</span>
                        @endif
                    </div>
                    <div class="product-content">
                        <h3><a href="/product/{{ $product->slug }}" wire:navigate>{{ $product->name }}</a></h3>
                        <div class="product-rating">
                            @for($i = 1; $i <= 5; $i++)
                            <svg viewBox="0 0 24 24" fill="{{ $i <= $product->rating ? '#FFB700' : 'none' }}" stroke="{{ $i <= $product->rating ? '#FFB700' : '#444' }}" stroke-width="2" style="width: 16px; height: 16px;">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                            @endfor
                        </div>
                        <div class="product-footer">
                            <span class="product-price">Rp {{ number_format($product->effective_price, 0, ',', '.') }}</span>
                            @livewire('add-to-cart-button', ['productId' => $product->id, 'showText' => false], key('plist-'.$product->id))
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
