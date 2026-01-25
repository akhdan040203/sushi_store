<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class History extends Component
{
    use WithPagination;

    public function render()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.product'])
            ->latest()
            ->paginate(10);

        return view('livewire.orders.history', [
            'orders' => $orders
        ])->layout('layouts.store', ['title' => 'My Orders - Sushi Ecommerce']);
    }
}
