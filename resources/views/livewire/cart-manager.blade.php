<div class="cart-container">
    <!-- Cart Icon with Count Badge -->
    <button wire:click="toggleCart" class="cart-toggle-btn" title="Shopping Cart">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 6h15l-1.5 9h-12z"/>
            <circle cx="9" cy="20" r="1"/>
            <circle cx="18" cy="20" r="1"/>
            <path d="M6 6L5 2H2"/>
        </svg>
        @if($cartCount > 0)
            <span class="cart-badge">{{ $cartCount }}</span>
        @endif
    </button>

    <!-- Cart Sidebar/Dropdown -->
    <div class="cart-sidebar {{ $isOpen ? 'open' : '' }}">
        <div class="cart-header">
            <div style="flex: 1; display: flex; justify-content: flex-end;">
                <button wire:click="toggleCart" class="close-cart-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="cart-body">
            @if(count($cartItems) > 0)
                @foreach($cartItems as $item)
                    <div class="cart-item" wire:key="cart-item-{{ $item->id }}">
                        <div class="cart-item-image">
                            <img src="{{ asset($item->product->image ?? 'images/placeholder.png') }}" alt="{{ $item->product->name }}">
                        </div>
                        <div class="cart-item-details">
                            <h4>{{ $item->product->name }}</h4>
                            <span class="cart-item-price">Rp {{ number_format($item->product->effective_price, 0, ',', '.') }}</span>
                            <div class="cart-item-quantity">
                                <button wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})" class="qty-btn">-</button>
                                <span>{{ $item->quantity }}</span>
                                <button wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})" class="qty-btn">+</button>
                            </div>
                        </div>
                        <button wire:click="removeItem({{ $item->id }})" class="remove-item-btn" title="Remove">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                @endforeach
            @else
                <div class="cart-empty">
                    <div class="cart-empty-logo">
                        <svg width="180" height="180" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="10" fill="rgba(255,122,0,0.03)" stroke="#FF7A00" stroke-width="0.5" stroke-dasharray="2 2"/>
                            <path d="M8 9h8l-1 5h-6l-1-5z" fill="#FF7A00" fill-opacity="0.1"/>
                            <path d="M6 6h15l-1.5 9h-12z" stroke="#FF7A00" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="9" cy="20" r="0.8" fill="#FF7A00"/>
                            <circle cx="18" cy="20" r="0.8" fill="#FF7A00"/>
                            <path d="M6 6L5 2H2" stroke="#FF7A00" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <a href="/items" wire:click="toggleCart" class="continue-shopping-btn">Explore Menu</a>
                </div>
            @endif
        </div>

        @if(count($cartItems) > 0)
            <div class="cart-footer">
                <div class="cart-subtotal">
                    <span>Subtotal:</span>
                    <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                </div>
                <a href="/checkout" wire:navigate class="checkout-btn">Proceed to Checkout</a>
                <button wire:click="clearCart" class="clear-cart-btn">Clear Cart</button>
            </div>
        @endif
    </div>

    <!-- Overlay when cart is open -->
    @if($isOpen)
        <div class="cart-overlay" wire:click="toggleCart"></div>
    @endif
</div>
