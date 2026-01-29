<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Sushi Ecommerce' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;400;500;600;700&family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/welcome.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>

        <ul class="nav-links">
            @if(request()->is('items') || request()->is('menu') || request()->is('service'))
                <li><a href="/">Home</a></li>
            @endif

            @if(!request()->is('items') && !request()->is('menu'))
                <li><a href="/items">Menu</a></li>
            @endif

            @if(!request()->is('service'))
                <li><a href="/service">Service</a></li>
            @endif
            <li><a href="{{ route('orders.history') }}">Order Track</a></li>
        </ul>

        <a href="/" class="logo">
            <div class="logo-text">
                SUSHIY<svg width="28" height="28" viewBox="0 0 24 24" fill="none" style="margin: 0 2px; vertical-align: middle;">
                    <circle cx="12" cy="12" r="10" fill="#FF7A00" stroke="#eee" stroke-width="0.5"/>
                    <ellipse cx="12" cy="12" rx="6" ry="3" fill="#111"/>
                    <circle cx="10" cy="11" r="1" fill="white"/>
                </svg>P
            </div>
        </a>
        
        <div class="nav-icons">
            @livewire('navbar-search')
            @livewire('cart-manager')
            <div class="desktop-profile">
                @livewire('profile-menu')
            </div>
        </div>
    </nav>
    
    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay" onclick="toggleMobileMenu()"></div>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <h3>Menu</h3>
            <button class="close-mobile-menu" onclick="toggleMobileMenu()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <ul class="mobile-nav-links">
            @if(request()->is('items') || request()->is('menu') || request()->is('service'))
                <li><a href="/" onclick="toggleMobileMenu()">Home</a></li>
            @endif

            @if(!request()->is('items') && !request()->is('menu'))
                <li><a href="/items" onclick="toggleMobileMenu()">Menu</a></li>
            @endif

            @if(!request()->is('service'))
                <li><a href="/service" onclick="toggleMobileMenu()">Service</a></li>
            @endif

            <li><a href="{{ route('orders.history') }}" onclick="toggleMobileMenu()">Order Track</a></li>
        </ul>

        <div class="mobile-menu-footer">
            @auth
                <div class="mobile-user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-role">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
                <div class="mobile-auth-links">
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('dashboard') }}" wire:navigate class="auth-link">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/></svg>
                            Admin Dashboard
                        </a>
                    @endif
                    <a href="{{ route('profile') }}" wire:navigate class="auth-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Profile Settings
                    </a>
                    <button onclick="document.getElementById('logout-form').submit()" class="auth-link logout-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Logout
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="mobile-login-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    LOGIN / REGISTER
                </a>
            @endauth
        </div>
    </div>

    {{ $slot }}

    <footer class="footer-v2">
        <div class="footer-v2-main">
            <div class="footer-v2-brand">
                <div class="logo-text footer-logo-text">
                    SUSHIY<svg width="22" height="22" viewBox="0 0 24 24" fill="none" style="margin: 0 2px; vertical-align: middle;">
                        <circle cx="12" cy="12" r="10" fill="#FF7A00" stroke="#eee" stroke-width="0.5"/>
                        <ellipse cx="12" cy="12" rx="6" ry="3" fill="#111"/>
                        <circle cx="10" cy="11" r="1" fill="white"/>
                    </svg>P
                </div>
                <p class="footer-v2-desc">Experience the art of authentic Japanese cuisine. Every piece is crafted with precision and the finest ingredients.</p>
                <div class="footer-v2-social">
                    <a href="#" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" aria-label="Twitter">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="#" aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>

            <div class="footer-v2-nav">
                <h4>Main Menu</h4>
                <ul>
                    <li><a href="/items">Our Menu</a></li>
                    <li><a href="/service">Our Story</a></li>
                    <li><a href="{{ route('orders.history') }}">Track Order</a></li>
                    <li><a href="#">Reservation</a></li>
                </ul>
            </div>

            <div class="footer-v2-nav">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Feedback</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>

            <div class="footer-v2-nav">
                <h4>Contact Us</h4>
                <div class="footer-v2-contact">
                    <div class="contact-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                        <span>(62) 812 3456 7890</span>
                    </div>
                    <div class="contact-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <span>support@sushiyop.com</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-v2-bottom">
            <p>&copy; {{ date('Y') }} SushiYop. All rights reserved.</p>
            <div class="footer-v2-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Use</a>
                <a href="#">Legal</a>
            </div>
        </div>
    </footer>


    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const overlay = document.getElementById('mobileMenuOverlay');
            if (menu && overlay) {
                menu.classList.toggle('open');
                overlay.classList.toggle('open');
                document.body.style.overflow = menu.classList.contains('open') ? 'hidden' : '';
            }
        }

        window.addEventListener('payment-ready', event => {
            console.log('Payment ready event received!', event.detail);
            const data = event.detail[0];
            
            if (!data.snapToken) {
                console.error('No snap token found!');
                alert('Internal Error: Snap Token missing.');
                return;
            }

            snap.pay(data.snapToken, {
                onSuccess: function(result) {
                    window.location.href = "/orders/track/" + data.orderNumber;
                },
                onPending: function(result) {
                    window.location.href = "/orders/track/" + data.orderNumber;
                },
                onError: function(result) {
                    alert("Payment failed!");
                },
                onClose: function() {
                    alert('You closed the popup without finishing the payment');
                }
            });
        });
    </script>


    @livewireScripts
    @stack('scripts')
</body>
</html>
