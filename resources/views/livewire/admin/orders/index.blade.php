<div>
    <div class="top-bar">
        <div class="page-title">
            <h1>Orders</h1>
            <p>Manage and track all customer orders</p>
        </div>
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
    </div>

    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; gap: 1rem; flex-wrap: wrap;">
            <div style="display: flex; gap: 1rem; flex: 1; flex-wrap: wrap;">
                <div class="search-wrapper">
                    <input wire:model.live="search" type="text" placeholder="Search order # or customer..." class="form-input">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <select wire:model.live="status" class="form-input" style="width: 200px;">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        @if (session()->has('message'))
            <div style="background: rgba(34,197,94,0.15); border-left: 4px solid #22C55E; color: #22C55E; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                {{ session('message') }}
            </div>
        @endif

        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <span style="font-family: monospace; font-weight: 600; color: #FF7A00;">#{{ $order->order_number }}</span>
                            </td>
                            <td>
                                <div style="font-weight: 600;">{{ $order->customer_name }}</div>
                                <div style="color: rgba(255,255,255,0.5); font-size: 0.8rem;">{{ $order->user->email ?? 'Guest' }}</div>
                            </td>
                            <td>
                                <span style="text-transform: capitalize;">{{ str_replace('_', ' ', $order->order_type) }}</span>
                                @if($order->table_number)
                                    <div style="color: rgba(255,255,255,0.4); font-size: 0.75rem;">Table: {{ $order->table_number }}</div>
                                @endif
                            </td>
                            <td>
                                @php
                                    $statusColor = match($order->status) {
                                        'pending' => 'rgba(234, 179, 8, 0.15)', // Yellow
                                        'processing' => 'rgba(59, 130, 246, 0.15)', // Blue
                                        'shipped' => 'rgba(168, 85, 247, 0.15)', // Purple
                                        'delivered' => 'rgba(34, 197, 94, 0.15)', // Green
                                        'cancelled' => 'rgba(239, 68, 68, 0.15)', // Red
                                        default => 'rgba(255, 255, 255, 0.05)'
                                    };
                                    $statusTextColor = match($order->status) {
                                        'pending' => '#EAB308',
                                        'processing' => '#3B82F6',
                                        'shipped' => '#A855F7',
                                        'delivered' => '#22C55E',
                                        'cancelled' => '#EF4444',
                                        default => '#FFFFFF'
                                    };
                                @endphp
                                <span style="background: {{ $statusColor }}; color: {{ $statusTextColor }}; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; text-transform: uppercase; font-weight: 600;">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $paymentColor = match($order->payment_status) {
                                        'pending' => 'rgba(234, 179, 8, 0.15)',
                                        'paid' => 'rgba(34, 197, 94, 0.15)',
                                        'failed' => 'rgba(239, 68, 68, 0.15)',
                                        default => 'rgba(255, 255, 255, 0.05)'
                                    };
                                    $paymentTextColor = match($order->payment_status) {
                                        'pending' => '#EAB308',
                                        'paid' => '#22C55E',
                                        'failed' => '#EF4444',
                                        default => '#FFFFFF'
                                    };
                                @endphp
                                <span style="background: {{ $paymentColor }}; color: {{ $paymentTextColor }}; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                    {{ strtoupper($order->payment_status) }}
                                </span>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #22C55E;">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                            </td>
                            <td style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </td>
                            <td style="text-align: right;">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-primary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; height: auto;">View Details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; color: rgba(255,255,255,0.5); padding: 3rem;">
                                No orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.05);">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
