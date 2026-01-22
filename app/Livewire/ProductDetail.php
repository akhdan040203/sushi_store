<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;
    public $quantity = 1;
    public $relatedProducts = [];

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with('category')
            ->firstOrFail();

        // Get related products from same category
        $this->relatedProducts = Product::where('category_id', $this->product->category_id)
            ->where('id', '!=', $this->product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->product->stock) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return;
        }
        $this->dispatch('addToCart', productId: $this->product->id, quantity: $this->quantity);
        $this->quantity = 1;
    }

    public function render()
    {
        return view('livewire.product-detail')
            ->layout('layouts.store', ['title' => $this->product->name . ' - Sushi Ecommerce']);
    }
}
