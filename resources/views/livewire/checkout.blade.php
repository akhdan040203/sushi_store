<div class="checkout-page">
    <style>
        .checkout-page {
            background: #111;
            min-height: 100vh;
            padding: 4rem 5% 6rem;
            color: white;
        }

        .checkout-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 3rem;
        }

        .checkout-header {
            grid-column: 1 / -1;
            margin-bottom: 2rem;
            text-align: center;
        }

        .checkout-header h1 {
            font-family: 'Cinzel', serif;
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .checkout-section {
            background: #1a1a1a;
            border-radius: 24px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 1rem 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: white;
            outline: none;
            transition: all 0.3s;
            font-family: inherit;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: var(--vibrant-orange);
            background: rgba(255, 255, 255, 0.1);
        }

        .type-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .type-btn {
            padding: 1rem;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            color: white;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .type-btn.active {
            border-color: var(--vibrant-orange);
            background: rgba(255, 122, 0, 0.1);
            color: var(--vibrant-orange);
        }

        .type-btn svg {
            width: 24px;
            height: 24px;
        }

        /* Order Summary Box */
        .summary-box {
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--vibrant-orange);
        }

        .checkout-btn {
            width: 100%;
            padding: 1.25rem;
            background: var(--vibrant-orange);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .checkout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 122, 0, 0.3);
        }

        .item-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .item-img {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
        }

        .item-info {
            flex: 1;
        }

        .item-info h4 {
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 0.2rem;
        }

        .item-info span {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Promo Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }

        .promo-modal {
            background: #1a1a1a;
            width: 90%;
            max-width: 550px;
            border-radius: 30px;
            padding: 3rem;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.1);
            position: relative;
            overflow: hidden;
        }

        .promo-modal::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: var(--vibrant-orange);
            filter: blur(80px);
            opacity: 0.3;
        }

        .promo-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .promo-modal h2 {
            font-family: 'Cinzel', serif;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .promo-modal p {
            color: rgba(255,255,255,0.7);
            line-height: 1.7;
            margin-bottom: 2.5rem;
        }

        .promo-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .login-promo-btn {
            background: white;
            color: #111;
            padding: 1rem;
            border-radius: 15px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
        }

        .login-promo-btn:hover {
            background: var(--vibrant-orange);
            color: white;
        }

        .guest-promo-btn {
            background: transparent;
            color: rgba(255,255,255,0.5);
            padding: 1rem;
            border-radius: 15px;
            border: 1px solid rgba(255,255,255,0.1);
            cursor: pointer;
            transition: all 0.3s;
        }

        .guest-promo-btn:hover {
            color: white;
            border-color: white;
        }

        @media (max-width: 992px) {
            .checkout-container {
                grid-template-columns: 1fr;
            }
            .summary-box {
                position: static;
            }
        }
    </style>

    <div class="checkout-header">
        <h1>CHECKOUT</h1>
        <p>Complete your order to enjoy our fresh sushi</p>
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
            <h2>Satu Langkah Lagi!</h2>
            <p>Tahukah kamu? Member Sushi kami mendapatkan bonus <strong>Gratis 1 Plate Sushi</strong> setiap kali order.<br><br>Kamu ingin lanjut bayar sebagai tamu atau gabung member sekarang untuk klaim bonusnya?</p>
            
            <div class="promo-actions">
                <a href="{{ route('register') }}" class="login-promo-btn">DAFTAR SEKARANG & AMBIL BONUS</a>
                <button class="guest-promo-btn" wire:click="processOrder" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="processOrder">Tetap Bayar sebagai Tamu</span>
                    <span wire:loading wire:target="processOrder">Processing...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        window.addEventListener('payment-ready', event => {
            console.log('Payment ready event received!', event.detail);
            const data = event.detail[0];
            
            if (!data.snapToken) {
                console.error('No snap token found!');
                alert('Internal Error: Snap Token missing.');
                return;
            }

            snap.pay(data.snapToken, {
                onSuccess: function(result) {
                    console.log('Payment success:', result);
                    window.location.href = "/orders/track/" + data.orderNumber;
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    window.location.href = "/orders/track/" + data.orderNumber;
                },
                onError: function(result) {
                    console.error('Payment error:', result);
                    alert("Payment failed!");
                },
                onClose: function() {
                    console.log('Customer closed the popup');
                    alert('You closed the popup without finishing the payment');
                }
            });
        });
    </script>
</div>


