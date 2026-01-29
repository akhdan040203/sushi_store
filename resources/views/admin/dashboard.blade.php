@push('styles')
    @vite('resources/css/admin-dashboard.css')
@endpush

<x-admin-layout>
    <x-slot:title>Dashboard</x-slot:title>

    <div class="top-bar">
        <div class="page-title">
            <h1>Dashboard</h1>
            <p>Welcome back, {{ Auth::user()->name }}! Here's what's happening.</p>
        </div>
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card orange">
            <div class="stat-icon orange">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <p class="stat-value">{{ $stats['totalProducts'] }}</p>
            <p class="stat-label">Total Products</p>
        </div>

        <div class="stat-card green">
            <div class="stat-icon green">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <p class="stat-value">{{ $stats['totalOrders'] }}</p>
            <p class="stat-label">Total Orders</p>
        </div>

        <div class="stat-card blue">
            <div class="stat-icon blue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <p class="stat-value">{{ $stats['totalCustomers'] }}</p>
            <p class="stat-label">Customers</p>
        </div>

        <div class="stat-card purple">
            <div class="stat-icon purple">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="stat-value">Rp {{ number_format($stats['totalRevenue'], 0, ',', '.') }}</p>
            <p class="stat-label">Total Revenue</p>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Recent Orders -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Orders</h3>
                <a href="{{ route('admin.orders.index') }}" class="view-all">View All</a>
            </div>
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Type</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td class="order-id" style="color: #FF7A00; font-weight: 600;">#{{ $order->order_number }}</td>
                            <td>{{ $order->customer_name ?? 'Guest' }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $order->order_type ?? 'dine_in')) }}</td>
                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $order->status === 'completed' ? 'badge-success' : ($order->status === 'pending' ? 'badge-warning' : 'badge-blue') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: rgba(255,255,255,0.5); padding: 2rem;">No orders yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions & Low Stock -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Actions</h3>
                </div>
                <div class="quick-actions">
                    <a href="{{ route('admin.products.create') }}" class="action-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        <span>Add New Product</span>
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="action-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        <span>Add New Category</span>
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="action-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        <span>Manage Inventory</span>
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Low Stock Alert</h3>
                </div>
                @forelse($topProducts as $product)
                <div class="stock-item">
                    <div class="stock-info">
                        <h4>{{ $product->name }}</h4>
                        <span style="color: #EF4444; font-size: 0.8rem;">{{ $product->stock }} items left</span>
                    </div>
                </div>
                @empty
                <p style="color: rgba(255,255,255,0.5); text-align: center; padding: 1rem;">All products well stocked!</p>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>
