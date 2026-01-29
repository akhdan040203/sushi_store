@push('styles')
    @vite('resources/css/checkout.css')
@endpush

<div class="checkout-page">

    <div class="checkout-header">
        <h1>CHECKOUT</h1>
        <p>Complete your order to enjoy our fresh sushi</p>
    </div>

    <div class="checkout-container">
        <div class="portfolio-notice">
            <svg style="width: 32px; height: 32px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>
            </svg>
            <p>
                <strong>Portfolio Project:</strong> Website ini hanya untuk demonstrasi. Pembayaran menggunakan <strong>Midtrans Sandbox</strong> (Simulasi). 
                Gunakan <a href="https://docs.midtrans.com/en/technical-reference/sandbox-test-variables" target="_blank">Midtrans Payment Simulator</a> untuk mencoba pembayaran.
            </p>
        </div>
    </div>

    <div class="checkout-container" style="grid-column: 1 / -1; margin-bottom: 2rem;">
        @if (session()->has('error'))
            <div style="background: rgba(239,68,68,0.15); border-left: 4px solid #EF4444; color: #EF4444; padding: 1rem; border-radius: 12px; margin-bottom: 1rem;">
                {{ session('error') }}
            </div>
        @endif
        @if (session()->has('success'))
            <div style="background: rgba(34,197,94,0.15); border-left: 4px solid #22C55E; color: #22C55E; padding: 1rem; border-radius: 12px; margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="checkout-container">
        <!-- Main Form -->
        <div class="checkout-main">
            <div class="checkout-section">
                <h3 class="section-title">
                    <svg style="width: 24px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Customer Information
                </h3>

                <div class="form-group">
                    <label>Order For</label>
                    <input type="text" wire:model="customer_name" placeholder="Enter your name" {{ Auth::check() ? '' : '' }}>
                    @error('customer_name') <span style="color: var(--accent-red); font-size: 0.8rem; margin-top: 0.5rem; display: block;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="checkout-section">
                <h3 class="section-title">
                    <svg style="width: 24px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Order Type
                </h3>

                <div class="type-options">
                    <button type="button" class="type-btn {{ $order_type === 'dine_in' ? 'active' : '' }}" wire:click="$set('order_type', 'dine_in')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                        Dine-In
                    </button>
                    <button type="button" class="type-btn {{ $order_type === 'takeaway' ? 'active' : '' }}" wire:click="$set('order_type', 'takeaway')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        Takeaway
                    </button>
                </div>

                @if($order_type === 'dine_in')
                <div class="form-group">
                    <label>Table Number</label>
                    <input type="text" wire:model="table_number" placeholder="e.g. 05">
                    @error('table_number') <span style="color: var(--accent-red); font-size: 0.8rem; margin-top: 0.5rem; display: block;">{{ $message }}</span> @enderror
                </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Summary -->
        <aside class="summary-box">
            <div class="checkout-section">
                <h3 class="section-title">Order Summary</h3>
                
                <div class="items-list" style="margin-bottom: 2rem;">
                    @foreach($cartItems as $item)
                    <div class="item-row">
                        <img src="{{ asset($item->product->image) }}" class="item-img" alt="">
                        <div class="item-info">
                            <h4>{{ $item->product->name }}</h4>
                            <span>{{ $item->quantity }} x Rp {{ number_format($item->product->effective_price, 0, ',', '.') }}</span>
                        </div>
                        <div style="font-weight: 600;">
                            Rp {{ number_format($item->quantity * $item->product->effective_price, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="summary-item">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="summary-item">
                    <span>Tax (10%)</span>
                    <span>Rp {{ number_format($subtotal * 0.1, 0, ',', '.') }}</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span>Rp {{ number_format($subtotal * 1.1, 0, ',', '.') }}</span>
                </div>

                <button class="checkout-btn" wire:click="attemptPayment" wire:loading.attr="disabled">
                    <span wire:loading.remove>Place Order</span>
                    <span wire:loading>Processing...</span>
                </button>
            </div>
        </aside>
    </div>

    @if($showPromoModal)
    <div class="modal-overlay">
        <div class="promo-modal">
            <span class="promo-icon">🍱</span>
            <h2>Just One More Step!</h2>
            <p>Did you know? Our Sushi Members get a <strong>FREE Sushi Plate</strong> bonus with every order.<br><br>Would you like to pay as a guest, or join as a member now to claim your bonus?</p>
            
            <div class="promo-actions">
                <a href="{{ route('register') }}" class="login-promo-btn">JOIN NOW & CLAIM BONUS</a>
                <button class="guest-promo-btn" wire:click="processOrder" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="processOrder">Continue Paying as Guest</span>
                    <span wire:loading wire:target="processOrder">Processing...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

</div>


