<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

use Midtrans\Config;
use Midtrans\Snap;

class History extends Component
{
    use WithPagination;

    public function payNow($orderId)
    {
        $order = Order::findOrFail($orderId);

        // If already paid, don't do anything
        if ($order->payment_status === 'paid') {
            session()->flash('error', 'Order ini sudah dibayar.');
            return;
        }

        // If we have a snap token, we can try to use it, 
        // but it's safer to regenerate if we want to be sure it's valid.
        
        // Midtrans Configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number . '-' . time(), // Use unique ID to avoid "Duplicate Order ID"
                'gross_amount' => (int) $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'email' => Auth::user()->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);
            
            $this->dispatch('payment-ready', ['snapToken' => $snapToken, 'orderNumber' => $order->order_number]);
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.product'])
            ->latest()
            ->paginate(5);

        return view('livewire.orders.history', [
            'orders' => $orders
        ])->layout('layouts.store', ['title' => 'My Orders - Sushi Ecommerce']);
    }
}
