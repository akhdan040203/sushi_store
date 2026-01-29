@push('styles')
    @vite('resources/css/history.css')
@endpush

<div class="history-page">

    <div class="history-container">
        <div class="history-header">
            <h1>Order History</h1>
            <p>Track your delicious sushi journeys</p>
        </div>

        @if (session()->has('error'))
            <div style="background: rgba(239,68,68,0.15); border-left: 4px solid #EF4444; color: #EF4444; padding: 1rem; border-radius: 4px; margin-bottom: 2rem;">
                {{ session('error') }}
            </div>
        @endif

        <div class="order-list">
            @forelse($orders as $order)
                <div class="order-card">
                    <div class="order-meta">
                        <div>
                            <span class="order-number">#{{ $order->order_number }}</span>
                            <span class="order-date ml-2">— {{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            @if($order->payment_status !== 'paid' && $order->status !== 'cancelled')
                                <button wire:click="payNow({{ $order->id }})" class="btn-track" style="background: rgba(34, 197, 94, 0.1); border-color: rgba(34, 197, 94, 0.3); color: #22C55E;">Pay Now</button>
                            @endif
                            <a href="{{ route('orders.track', $order->order_number) }}" class="btn-track">Track Order</a>
                            <span class="order-status status-{{ $order->status }}">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>

                    <div class="items-list">
                        @foreach($order->items as $item)
                        <div class="item-row">
                            <img src="{{ asset($item->product->image ?? 'images/placeholder.png') }}" class="item-image" alt="{{ $item->product->name }}">
                            <div class="item-info">
                                <div class="item-name">{{ $item->product->name }}</div>
                                <div class="item-price">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                            <div class="item-subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                        </div>
                        @endforeach
                    </div>

                    <div class="order-footer">
                        <span style="font-size: 0.8rem; font-weight: 600; color: {{ $order->payment_status == 'paid' ? '#22C55E' : '#EAB308' }}; display: flex; align-items: center; gap: 0.4rem;">
                            {{ $order->payment_status == 'paid' ? 'PAYMENT SUCCESSFUL' : 'PAYMENT PENDING' }}
                            @if($order->payment_status == 'paid')
                                <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l5-5z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </span>
                        <div class="order-total">
                            Total: Rp {{ number_format($order->total, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-orders-state">
                    {{-- Decorative Icon --}}
                    <div class="empty-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            <path d="M9 14l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 class="empty-title">No Orders Yet</h3>
                    <p class="empty-subtitle">You haven't ordered anything yet. Start your sushi journey today!</p>
                    <a href="{{ route('items') }}" class="btn-start-ordering">
                        <span>Start Ordering</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @endforelse
        </div>

        <div class="pagination">
            {{ $orders->links() }}
        </div>
    </div>
</div>
