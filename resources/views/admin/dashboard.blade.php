<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sushi Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #0f0f0f;
            color: #fff;
            min-height: 100vh;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: #1a1a1a;
            border-right: 1px solid rgba(255,255,255,0.05);
            padding: 2rem 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 0 1.5rem 2rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            margin-bottom: 1.5rem;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: white;
        }

        .sidebar-logo svg {
            width: 40px;
            height: 40px;
        }

        .sidebar-logo span {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .sidebar-nav {
            padding: 0 1rem;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-section-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.4);
            padding: 0 0.75rem;
            margin-bottom: 0.75rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            border-radius: 12px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.2s;
            margin-bottom: 0.25rem;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.05);
            color: white;
        }

        .nav-item.active {
            background: linear-gradient(135deg, #FF7A00, #FF9F43);
            color: white;
            box-shadow: 0 4px 15px rgba(255,122,0,0.3);
        }

        .nav-item svg {
            width: 20px;
            height: 20px;
        }

        .nav-item span {
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title h1 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .page-title p {
            color: rgba(255,255,255,0.5);
            font-size: 0.9rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: linear-gradient(135deg, #FF7A00, #FF9F43);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: #1a1a1a;
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid rgba(255,255,255,0.05);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            filter: blur(50px);
            opacity: 0.15;
        }

        .stat-card.orange::before { background: #FF7A00; }
        .stat-card.green::before { background: #22C55E; }
        .stat-card.blue::before { background: #3B82F6; }
        .stat-card.purple::before { background: #A855F7; }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .stat-icon.orange { background: rgba(255,122,0,0.15); color: #FF7A00; }
        .stat-icon.green { background: rgba(34,197,94,0.15); color: #22C55E; }
        .stat-icon.blue { background: rgba(59,130,246,0.15); color: #3B82F6; }
        .stat-icon.purple { background: rgba(168,85,247,0.15); color: #A855F7; }

        .stat-icon svg {
            width: 24px;
            height: 24px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: rgba(255,255,255,0.5);
            font-size: 0.85rem;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }

        .card {
            background: #1a1a1a;
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .view-all {
            color: #FF7A00;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Orders Table */
        .orders-table {
            width: 100%;
        }

        .orders-table th {
            text-align: left;
            padding: 0.75rem 1rem;
            color: rgba(255,255,255,0.5);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .orders-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            font-size: 0.9rem;
        }

        .order-id {
            font-weight: 600;
            color: #FF7A00;
        }

        .status-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-pending { background: rgba(234,179,8,0.15); color: #EAB308; }
        .status-processing { background: rgba(59,130,246,0.15); color: #3B82F6; }
        .status-completed { background: rgba(34,197,94,0.15); color: #22C55E; }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(255,255,255,0.03);
            border-radius: 14px;
            text-decoration: none;
            color: white;
            transition: all 0.2s;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .action-btn:hover {
            background: rgba(255,122,0,0.1);
            border-color: rgba(255,122,0,0.3);
            transform: translateX(5px);
        }

        .action-btn svg {
            width: 20px;
            height: 20px;
            color: #FF7A00;
        }

        .action-btn span {
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Low Stock Items */
        .stock-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }

        .stock-item:last-child {
            border-bottom: none;
        }

        .stock-item img {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            object-fit: cover;
        }

        .stock-info {
            flex: 1;
        }

        .stock-info h4 {
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .stock-info span {
            font-size: 0.8rem;
            color: #EF4444;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main-content {
                margin-left: 0;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="/" class="sidebar-logo">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" fill="#FF9F43"/>
                        <ellipse cx="12" cy="12" rx="6" ry="3" fill="#1a1a1a"/>
                        <circle cx="10" cy="11" r="1" fill="white"/>
                    </svg>
                    <span>SUSHI</span>
                </a>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <p class="nav-section-title">Main Menu</p>
                    <a href="{{ route('dashboard') }}" class="nav-item active">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="nav-section">
                    <p class="nav-section-title">Management</p>
                    <a href="{{ route('admin.products.index') }}" class="nav-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <span>Products</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="nav-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <span>Categories</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="nav-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Orders</span>
                    </a>
                    <a href="#" class="nav-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Customers</span>
                    </a>
                </div>

                <div class="nav-section">
                    <p class="nav-section-title">Settings</p>
                    <a href="{{ route('profile') }}" class="nav-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Settings</span>
                    </a>
                    <a href="/" class="nav-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>View Store</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="top-bar">
                <div class="page-title">
                    <h1>Dashboard</h1>
                    <p>Welcome back, {{ Auth::user()->name }}! Here's what's happening.</p>
                </div>
                <div class="user-menu">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                </div>
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
                    <table class="orders-table">
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
                                <td class="order-id">#{{ $order->order_number }}</td>
                                <td>{{ $order->customer_name ?? 'Guest' }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $order->order_type ?? 'dine_in')) }}</td>
                                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td>
                                    <span class="status-badge status-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: rgba(255,255,255,0.5);">No orders yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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
                            <img src="{{ asset($product->image ?? 'images/placeholder.png') }}" alt="{{ $product->name }}">
                            <div class="stock-info">
                                <h4>{{ $product->name }}</h4>
                                <span>{{ $product->stock }} items left</span>
                            </div>
                        </div>
                        @empty
                        <p style="color: rgba(255,255,255,0.5); text-align: center; padding: 1rem;">All products well stocked!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
