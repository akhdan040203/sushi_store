<button 
    wire:click="addToCart" 
    class="add-cart-btn-text"
    title="{{ auth()->check() && auth()->user()->isAdmin() ? 'Admins cannot place orders' : 'ADD TO CART' }}"
    {{ auth()->check() && auth()->user()->isAdmin() ? 'disabled' : '' }}
>
    <span>ADD TO CART</span>
</button>
