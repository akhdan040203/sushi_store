<div class="history-page">
    <style>
        .history-page {
            background: #111;
            min-height: 100vh;
            padding: 4rem 5% 6rem;
            color: white;
        }

        .history-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .history-header {
            margin-bottom: 3rem;
            text-align: center;
        }

        .history-header h1 {
            font-family: 'Cinzel', serif;
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .order-card {
            background: #1a1a1a;
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: transform 0.3s;
        }

        .order-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 122, 0, 0.3);
        }

        .order-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .order-number {
            font-family: 'Cinzel', serif;
            color: #FF7A00;
            font-weight: 700;
        }

        .order-date {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }

        .order-status {
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending { background: rgba(234, 179, 8, 0.15); color: #EAB308; }
        .status-processing { background: rgba(59, 130, 246, 0.15); color: #3B82F6; }
        .status-shipped { background: rgba(168, 85, 247, 0.15); color: #A855F7; }
        .status-delivered { background: rgba(34, 197, 94, 0.15); color: #22C55E; }
        .status-cancelled { background: rgba(239, 68, 68, 0.15); color: #EF4444; }

        .items-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .item-row {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            object-fit: cover;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .item-price {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px dotted rgba(255, 255, 255, 0.1);
        }

        .order-total {
            font-size: 1.2rem;
            font-weight: 700;
            color: #22C55E;
        }


        .pagination {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .order-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .order-footer {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .order-total {
                font-size: 1rem;
            }

            .history-header h1 {
                font-size: 2rem;
            }
        }
    </style>

    <div class="history-container">
        <div class="history-header">
            <h1>Order History</h1>
            <p>Track your delicious sushi journeys</p>
        </div>

        <div class="order-list">
            @forelse($orders as $order)
                <div class="order-card">
                    <div class="order-meta">
                        <div>
                            <span class="order-number">#{{ $order->order_number }}</span>
                            <span class="order-date ml-2">— {{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <a href="{{ route('orders.track', $order->order_number) }}" class="btn-primary" style="padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.75rem; background: rgba(255,122,0,0.1); color: #FF7A00; border: 1px solid #FF7A00; text-decoration: none;">Track Order</a>
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
                <div class="text-center py-10">
                    <p style="color: rgba(255,255,255,0.5); font-size: 1.2rem;">You haven't ordered anything yet.</p>
                    <a href="{{ route('items') }}" class="btn-primary mt-4" style="display: inline-block; text-decoration: none; background: #FF7A00; color: white; padding: 0.8rem 2rem; border-radius: 50px; margin-top: 1rem;">Start Ordering</a>
                </div>
            @endforelse
        </div>

        <div class="pagination">
            {{ $orders->links() }}
        </div>
    </div>
</div>
