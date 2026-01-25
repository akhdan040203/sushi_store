<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.admin-layout')]
class Show extends Component
{
    public Order $order;

    public function mount($id)
    {
        $this->order = Order::with(['items.product', 'user'])->findOrFail($id);
    }

    public function updateStatus($newStatus)
    {
        $this->order->update(['status' => $newStatus]);
        session()->flash('message', "Status pesanan berhasil diubah menjadi " . ucfirst($newStatus));
    }

    public function render()
    {
        return view('livewire.admin.orders.show');
    }
}
