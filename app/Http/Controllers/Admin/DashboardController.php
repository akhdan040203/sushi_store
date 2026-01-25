<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            'totalCustomers' => User::where('role', 'customer')->count(),
            'totalRevenue' => Order::where('payment_status', 'paid')->sum('total'),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'todayOrders' => Order::whereDate('created_at', today())->count(),
            'lowStockProducts' => Product::where('stock', '<', 10)->count(),
            'totalCategories' => Category::count(),
        ];

        $recentOrders = Order::with('items.product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $topProducts = Product::orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topProducts'));
    }
}
