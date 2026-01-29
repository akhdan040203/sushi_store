<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Midtrans\Config;
use Midtrans\Snap;

class Checkout extends Component
{
    public $customer_name = '';
    public $table_number = '';
    public $order_type = 'dine_in';
    public $showPromoModal = false;
    public $cartItems = [];
    public $subtotal = 0;
    public $snapToken = null;


    public function mount()
    {
        $this->loadCart();
        
        if (Auth::check()) {
            $this->customer_name = Auth::user()->name;
        }
    }

    public function loadCart()
    {
        if (Auth::check()) {
            $this->cartItems = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get();
        } else {
            $sessionCart = session()->get('cart', []);
            $this->cartItems = collect($sessionCart)->map(function ($item) {
                $product = Product::find($item['product_id']);
                return (object) [
                    'product_id' => $item['product_id'],
                    'product' => $product,
                    'quantity' => $item['quantity'],
                ];
            })->filter(fn($item) => $item->product !== null);
        }

        if ($this->cartItems->isEmpty()) {
            return redirect()->to('/items');
        }

        $this->subtotal = $this->cartItems->sum(function ($item) {
            return $item->quantity * $item->product->effective_price;
        });
    }

    public function attemptPayment()
    {
        $this->validate([
            'customer_name' => 'required|min:3',
            'order_type' => 'required|in:dine_in,takeaway',
            'table_number' => $this->order_type === 'dine_in' ? 'required' : 'nullable',
        ], [
            'customer_name.required' => 'Nama harus diisi.',
            'table_number.required' => 'Nomor meja wajib diisi jika makan di tempat.',
        ]);

        if (!Auth::check()) {
            $this->showPromoModal = true;
        } else {
            $this->processOrder();
        }
    }

    public function processOrder()
    {
        $this->showPromoModal = false;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $this->customer_name,
                'order_number' => Order::generateOrderNumber(),
                'order_type' => $this->order_type,
                'table_number' => $this->order_type === 'dine_in' ? $this->table_number : null,
                'status' => 'pending',
                'subtotal' => $this->subtotal,
                'total' => $this->subtotal * 1.1, // Include 10% Tax
                'payment_status' => 'pending',
            ]);

            foreach ($this->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->effective_price,
                    'subtotal' => $item->quantity * $item->product->effective_price,
                ]);

                // Decrement Stock
                Product::where('id', $item->product_id)->decrement('stock', $item->quantity);
            }

            $order->update(['stock_decremented' => true]);

            // Midtrans Configuration
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => (int) $order->total,
                ],
                'customer_details' => [
                    'first_name' => $this->customer_name,
                    'email' => Auth::check() ? Auth::user()->email : 'guest@example.com',
                ],
            ];

            $this->snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $this->snapToken]);

            DB::commit();

            // Clear cart early (optional, or wait for success)
            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->delete();
            } else {
                session()->forget('cart');
            }

            $this->dispatch('cartUpdated');
            $this->dispatch('payment-ready', ['snapToken' => $this->snapToken, 'orderNumber' => $order->order_number]);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.checkout')
            ->layout('layouts.store', ['title' => 'Checkout - Sushi Ecommerce']);
    }
}
