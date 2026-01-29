<div class="search-container-v5" x-data="{ open: false }" @click.away="open = false">
    <div class="search-bar-redesign">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input 
            type="text" 
            placeholder="Search sushi..." 
            wire:model.live.debounce.300ms="search"
            @focus="open = true"
            @keydown.escape="open = false"
        >
    </div>

    @if(!empty($results))
        <div class="search-suggestions" x-show="open" x-transition>
            @foreach($results as $product)
                <a href="/product/{{ $product->slug }}" class="suggestion-item">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    <div class="suggestion-info">
                        <span class="suggestion-name">{{ $product->name }}</span>
                        <span class="suggestion-price">Rp {{ number_format($product->effective_price, 0, ',', '.') }}</span>
                    </div>
                </a>
            @endforeach
            
            @if(count($results) >= 5)
                <a href="/items?search={{ $search }}" class="view-all-results">
                    View all results for "{{ $search }}"
                </a>
            @endif
        </div>
    @elseif(strlen($search) >= 2 && empty($results))
         <div class="search-suggestions" x-show="open">
            <div class="no-suggestions">No products found for "{{ $search }}"</div>
         </div>
    @endif
</div>
