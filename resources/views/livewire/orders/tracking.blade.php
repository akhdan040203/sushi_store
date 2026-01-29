@push('styles')
    @vite('resources/css/tracking.css')
@endpush

<div class="tracking-page" wire:poll.3s>

    <div class="tracking-container">
        <div class="tracking-header">
            <p style="color: rgba(255,255,255,0.5); margin-bottom: 0.5rem;">ORDER TRACKING</p>
            <h1>#{{ $order->order_number }}</h1>
        </div>

        @php
            $statuses = ['pending', 'processing', 'shipped', 'delivered'];
            $currentIndex = array_search($order->status, $statuses);
            $progressWidth = ($currentIndex / (count($statuses) - 1)) * 100;
        @endphp

        <div class="stepper">
            <div class="step-progress" style="width: {{ $progressWidth }}%;"></div>
            
            <div class="step {{ $currentIndex >= 0 ? ($currentIndex > 0 ? 'completed' : 'active') : '' }}">
                <div class="step-icon">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="step-label">Placed</div>
            </div>

            <div class="step {{ $currentIndex >= 1 ? ($currentIndex > 1 ? 'completed' : 'active') : '' }}">
                <div class="step-icon">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="step-label">Preparing</div>
            </div>

            <div class="step {{ $currentIndex >= 2 ? ($currentIndex > 2 ? 'completed' : 'active') : '' }}">
                <div class="step-icon">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div class="step-label">Ready</div>
            </div>

            <div class="step {{ $currentIndex >= 3 ? ($currentIndex > 3 ? 'completed' : 'active') : '' }}">
                <div class="step-icon">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="step-label">Arrived</div>
            </div>
        </div>

        <div class="order-status-card">
            <div class="status-hero">
                @if($order->status != 'delivered' && $order->status != 'cancelled')
                    <div class="pulse-animation"></div>
                @endif
                <div class="status-main">
                    @if($order->status == 'pending')
                        Awaiting Confirmation
                    @elseif($order->status == 'processing')
                        Sushis in the Making
                    @elseif($order->status == 'shipped')
                        Order is Ready!
                    @elseif($order->status == 'delivered')
                        Enjoy Your Meal!
                    @elseif($order->status == 'cancelled')
                        Order Cancelled
                    @endif
                </div>
                <div class="status-desc">
                    @if($order->status == 'pending')
                        We are checking your order details.
                    @elseif($order->status == 'processing')
                        Our chef is handcrafting your sushi using fresh ingredients.
                    @elseif($order->status == 'shipped')
                        Your order is ready for pickup or service.
                    @elseif($order->status == 'delivered')
                        Thank you for choosing SushiYup.
                    @elseif($order->status == 'cancelled')
                        This order could not be processed.
                    @endif
                </div>
            </div>

            <div class="summary-mini">
                <div class="summary-item">
                    <div class="summary-label">Estimated Completion</div>
                    <div class="summary-value" style="color: #FF7A00;">
                        @if($order->status == 'processing')
                            ~15-20 Minutes
                        @elseif($order->status == 'shipped')
                            Ready Now
                        @elseif($order->status == 'delivered')
                            Completed
                        @else
                            Awaiting...
                        @endif
                    </div>
                </div>
                <div class="summary-item" style="text-align: right;">
                    <div class="summary-label">Total Payment</div>
                    <div class="summary-value">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Order Type</div>
                    <div class="summary-value">{{ ucfirst(str_replace('_', ' ', $order->order_type)) }}</div>
                </div>
                <div class="summary-item" style="text-align: right;">
                    <div class="summary-label">Table Number</div>
                    <div class="summary-value">{{ $order->table_number ?? 'Takeaway' }}</div>
                </div>
            </div>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('orders.history') }}" class="btn-back">
                &larr; Back to Order History
            </a>
        </div>
    </div>
</div>
