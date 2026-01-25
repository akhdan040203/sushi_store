<div>
    <div class="top-bar">
        <div class="page-title">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <a href="{{ route('admin.orders.index') }}" style="color: rgba(255,255,255,0.6); text-decoration: none;">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1>Order #{{ $order->order_number }}</h1>
                    <p>Detailed view and management for this order</p>
                </div>
            </div>
        </div>
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
        <!-- Order Items & Customer Details -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="admin-card">
                <h3 style="margin-bottom: 1.5rem; color: #FF7A00; font-size: 1.1rem;">Customer & Preparation Information</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div>
                        <div style="color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-bottom: 0.25rem;">Customer Name</div>
                        <div style="font-weight: 600; font-size: 1rem;">{{ $order->customer_name }}</div>
                    </div>
                    <div>
                        <div style="color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-bottom: 0.25rem;">Email Address</div>
                        <div style="font-weight: 600; font-size: 1rem;">{{ $order->user->email ?? 'Guest Order' }}</div>
                    </div>
                    <div>
                        <div style="color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-bottom: 0.25rem;">Order Type</div>
                        <div style="font-weight: 600; font-size: 1rem; text-transform: capitalize;">{{ str_replace('_', ' ', $order->order_type) }}</div>
                    </div>
                    <div>
                        <div style="color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-bottom: 0.25rem;">Table Number</div>
                        <div style="font-weight: 600; font-size: 1rem;">{{ $order->table_number ?? '-' }}</div>
                    </div>
                </div>
                @if($order->notes)
                <div style="margin-top: 1.5rem;">
                    <div style="color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-bottom: 0.25rem;">Order Notes</div>
                    <div style="background: rgba(255,255,255,0.03); padding: 1rem; border-radius: 8px; font-style: italic;">"{{ $order->notes }}"</div>
                </div>
                @endif
            </div>

            <div class="admin-card">
                <h3 style="margin-bottom: 1.5rem; color: #FF7A00; font-size: 1.1rem;">Order Items</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Price</th>
                            <th style="text-align: right;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <img src="{{ asset($item->product->image ?? 'images/placeholder.png') }}" style="width: 40px; height: 40px; border-radius: 8px; object-fit: cover;">
                                    <div style="font-weight: 600;">{{ $item->product->name }}</div>
                                </div>
                            </td>
                            <td style="text-align: center;">{{ $item->quantity }}</td>
                            <td style="text-align: right;">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td style="text-align: right; font-weight: 600;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right; border: none; padding-top: 2rem;">Subtotal</td>
                            <td style="text-align: right; border: none; padding-top: 2rem;">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right; border: none; font-weight: 600; font-size: 1.2rem; color: #22C55E;">Total Amount</td>
                            <td style="text-align: right; border: none; font-weight: 600; font-size: 1.2rem; color: #22C55E;">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Order Management Section -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="admin-card">
                <h3 style="margin-bottom: 1.5rem; color: #FF7A00; font-size: 1.1rem;">Manage Status</h3>
                
                @if (session()->has('message'))
                    <div style="background: rgba(34,197,94,0.15); color: #22C55E; padding: 0.75rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem;">
                        {{ session('message') }}
                    </div>
                @endif

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-bottom: 0.5rem;">Payment Status</label>
                    @php
                        $payColor = match($order->payment_status) { 'paid' => '#22C55E', 'failed' => '#EF4444', default => '#EAB308' };
                    @endphp
                    <div style="background: {{ $payColor }}15; color: {{ $payColor }}; padding: 0.75rem; border-radius: 8px; text-align: center; font-weight: 700; text-transform: uppercase;">
                        {{ $order->payment_status }}
                    </div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-bottom: 0.5rem;">Order Status Workflow</label>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <button wire:click="updateStatus('processing')" @class(['btn-primary', 'active' => $order->status == 'processing']) style="justify-content: center; height: 45px; {{ $order->status == 'processing' ? 'background: #3B82F6;' : 'background: rgba(255,255,255,0.05); color: white;' }}">
                            Mark as Processing
                        </button>
                        <button wire:click="updateStatus('shipped')" @class(['btn-primary', 'active' => $order->status == 'shipped']) style="justify-content: center; height: 45px; {{ $order->status == 'shipped' ? 'background: #A855F7;' : 'background: rgba(255,255,255,0.05); color: white;' }}">
                            Mark as Shipped / Prepared
                        </button>
                        <button wire:click="updateStatus('delivered')" @class(['btn-primary', 'active' => $order->status == 'delivered']) style="justify-content: center; height: 45px; {{ $order->status == 'delivered' ? 'background: #22C55E;' : 'background: rgba(255,255,255,0.05); color: white;' }}">
                            Mark as Completed
                        </button>
                        <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin: 0.5rem 0;">
                        <button wire:click="updateStatus('cancelled')" class="link-delete" style="justify-content: center; height: 45px; border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 10px;">
                            Cancel Order
                        </button>
                    </div>
                </div>

                <div style="color: rgba(255,255,255,0.4); font-size: 0.75rem; text-align: center;">
                    Ordered on: {{ $order->created_at->format('M d, Y @ H:i') }}
                </div>
            </div>
        </div>
    </div>
</div>
