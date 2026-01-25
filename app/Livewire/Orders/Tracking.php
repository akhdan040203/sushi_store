<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tracking extends Component
{
    public $orderNumber;

    public function mount($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    public function getOrderProperty()
    {
        return Order::where('order_number', $this->orderNumber)
            ->where('user_id', Auth::id())
            ->with(['items.product'])
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.orders.tracking', [
            'order' => $this->order
        ])->layout('layouts.store', ['title' => 'Track Order #' . $this->orderNumber]);
    }
}
