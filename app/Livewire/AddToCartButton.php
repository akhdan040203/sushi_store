<?php

namespace App\Livewire;

use Livewire\Component;

class AddToCartButton extends Component
{
    public $productId;
    public $showText = true;
    public $size = 'normal'; // 'small', 'normal', 'large'

    public function addToCart()
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return;
        }
        $this->dispatch('addToCart', productId: $this->productId, quantity: 1);
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
