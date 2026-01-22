<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartManager extends Component
{
    public $cartItems = [];
    public $cartCount = 0;
    public $subtotal = 0;
    public $isOpen = false;

    protected $listeners = ['cartUpdated' => 'loadCart', 'toggleCart' => 'toggleCart', 'addToCart' => 'addToCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        if (Auth::check()) {
            $this->cartItems = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get();
            $this->cartCount = $this->cartItems->sum('quantity');
            $this->subtotal = $this->cartItems->sum(function ($item) {
                return $item->quantity * $item->product->effective_price;
            });
        } else {
            // Guest cart from session
            $sessionCart = session()->get('cart', []);
            $this->cartItems = collect($sessionCart)->map(function ($item) {
                $product = Product::find($item['product_id']);
                return (object) [
                    'id' => $item['product_id'],
                    'product' => $product,
                    'quantity' => $item['quantity'],
                ];
            })->filter(fn($item) => $item->product !== null);
            $this->cartCount = $this->cartItems->sum('quantity');
            $this->subtotal = $this->cartItems->sum(function ($item) {
                return $item->quantity * $item->product->effective_price;
            });
        }
    }

    public function toggleCart()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function addToCart($productId, $quantity = 1)
    {
        $product = Product::findOrFail($productId);

        if ($product->stock < $quantity) {
            session()->flash('error', 'Stok tidak mencukupi!');
            return;
        }

        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $quantity);
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            // Guest cart - store in session
            $cart = session()->get('cart', []);
            
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ];
            }
            
            session()->put('cart', $cart);
        }

        $this->loadCart();
        $this->dispatch('cartUpdated');
        session()->flash('success', 'Produk ditambahkan ke keranjang!');
    }

    public function updateQuantity($cartItemId, $quantity)
    {
        if ($quantity < 1) {
            $this->removeItem($cartItemId);
            return;
        }

        if (Auth::check()) {
            $cartItem = Cart::find($cartItemId);
            if ($cartItem && $cartItem->user_id === Auth::id()) {
                if ($cartItem->product->stock >= $quantity) {
                    $cartItem->update(['quantity' => $quantity]);
                } else {
                    session()->flash('error', 'Stok tidak mencukupi!');
                }
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$cartItemId])) {
                $product = Product::find($cartItemId);
                if ($product && $product->stock >= $quantity) {
                    $cart[$cartItemId]['quantity'] = $quantity;
                    session()->put('cart', $cart);
                }
            }
        }

        $this->loadCart();
    }

    public function removeItem($cartItemId)
    {
        if (Auth::check()) {
            Cart::where('id', $cartItemId)
                ->where('user_id', Auth::id())
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$cartItemId]);
            session()->put('cart', $cart);
        }

        $this->loadCart();
        $this->dispatch('cartUpdated');
    }

    public function clearCart()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        $this->loadCart();
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.cart-manager');
    }
}
