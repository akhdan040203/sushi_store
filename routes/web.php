<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

Route::get('/', [HomeController::class, 'index']);

// Product Detail Page
Route::get('/product/{slug}', \App\Livewire\ProductDetail::class)->name('product.show');

// Items Page
Route::get('/items', \App\Livewire\ProductList::class)->name('items');

// Checkout Page
Route::get('/checkout', \App\Livewire\Checkout::class)->name('checkout');

// About Us Page
Route::view('/about', 'about')->name('about');

Route::get('dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Admin Routes - Protected by auth and admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Products
    Route::get('/products', \App\Livewire\Admin\Products\Index::class)->name('products.index');
    Route::get('/products/create', \App\Livewire\Admin\Products\Create::class)->name('products.create');
    Route::get('/products/{id}/edit', \App\Livewire\Admin\Products\Edit::class)->name('products.edit');
    
    // Categories
    Route::get('/categories', \App\Livewire\Admin\Categories\Index::class)->name('categories.index');
    Route::get('/categories/create', \App\Livewire\Admin\Categories\Create::class)->name('categories.create');
    Route::get('/categories/{id}/edit', \App\Livewire\Admin\Categories\Edit::class)->name('categories.edit');
});

require __DIR__.'/auth.php';
