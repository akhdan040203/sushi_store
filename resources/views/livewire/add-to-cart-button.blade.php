<button 
    wire:click="addToCart" 
    class="add-cart-btn add-cart-btn-{{ $size }}"
    title="{{ auth()->check() && auth()->user()->isAdmin() ? 'Admin tidak dapat melakukan pemesanan' : 'Tambah ke Keranjang' }}"
    {{ auth()->check() && auth()->user()->isAdmin() ? 'disabled' : '' }}
    style="{{ auth()->check() && auth()->user()->isAdmin() ? 'opacity: 0.5; cursor: not-allowed;' : '' }}"
>
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M6 6h15l-1.5 9h-12z"/>
        <circle cx="9" cy="20" r="1"/>
        <circle cx="18" cy="20" r="1"/>
        <path d="M6 6L5 2H2"/>
    </svg>
    @if($showText)
        <span>Tambah</span>
    @endif
</button>
