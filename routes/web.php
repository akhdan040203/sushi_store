<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\PaymentCallbackController;

Route::get('/', [HomeController::class, 'index']);

Route::post('/logout', function (\App\Livewire\Actions\Logout $logout) {
    $logout();
    return redirect('/');
})->name('logout');

Route::post('/payment/callback', [PaymentCallbackController::class, 'receive']);

// Product Detail Page
Route::get('/product/{slug}', \App\Livewire\ProductDetail::class)->name('product.show');

// Items Page
Route::get('/items', \App\Livewire\ProductList::class)->name('items');

// Checkout Page
Route::get('/checkout', \App\Livewire\Checkout::class)->name('checkout');

// Order History & Tracking
Route::get('/orders/history', \App\Livewire\Orders\History::class)
    ->middleware(['auth'])
    ->name('orders.history');

Route::get('/orders/track/{orderNumber}', \App\Livewire\Orders\Tracking::class)
    ->middleware(['auth'])
    ->name('orders.track');

// Service Page
Route::view('/service', 'service')->name('service');

Route::get('dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth', 'verified'])
    ->name('profile');

// Admin Routes - Protected by auth, verified, and admin middleware
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Products
    Route::get('/products', \App\Livewire\Admin\Products\Index::class)->name('products.index');
    Route::get('/products/create', \App\Livewire\Admin\Products\Create::class)->name('products.create');
    Route::get('/products/{id}/edit', \App\Livewire\Admin\Products\Edit::class)->name('products.edit');
    
    // Categories
    Route::get('/categories', \App\Livewire\Admin\Categories\Index::class)->name('categories.index');
    Route::get('/categories/create', \App\Livewire\Admin\Categories\Create::class)->name('categories.create');
    Route::get('/categories/{id}/edit', \App\Livewire\Admin\Categories\Edit::class)->name('categories.edit');

    // Orders
    Route::get('/orders', \App\Livewire\Admin\Orders\Index::class)->name('orders.index');
    Route::get('/orders/{id}', \App\Livewire\Admin\Orders\Show::class)->name('orders.show');

    // Users
    Route::get('/users', \App\Livewire\Admin\Users\Index::class)->name('users.index');

    // Broadcast
    Route::get('/broadcast', \App\Livewire\Admin\Broadcast::class)->name('broadcast');
});

require __DIR__.'/auth.php';
