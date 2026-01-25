<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Sushi Ecommerce' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/welcome.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="/" class="logo">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10" fill="#FF9F43"/>
                <ellipse cx="12" cy="12" rx="6" ry="3" fill="#1a1a1a"/>
                <circle cx="10" cy="11" r="1" fill="white"/>
            </svg>
            <span>SUSHI</span>
        </a>
        
        <ul class="nav-links">
            <li><a href="/">HOME</a></li>
            <li><a href="/items">ITEMS</a></li>
            <li><a href="/#services">SERVICES</a></li>
            <li><a href="/about">ABOUT US</a></li>
            @auth
                <li><a href="{{ route('orders.history') }}">MY ORDERS</a></li>
            @endauth
        </ul>
        
        <div class="nav-icons">
            @livewire('cart-manager')
            
            <a href="#" title="Wishlist" class="wishlist-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </a>
            @livewire('profile-menu')
        </div>
        
        <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
    </nav>
    
    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay" onclick="toggleMobileMenu()"></div>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <h3>Menu</h3>
            <button class="close-mobile-menu" onclick="toggleMobileMenu()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <ul class="mobile-nav-links">
            <li><a href="/" onclick="toggleMobileMenu()">HOME</a></li>
            <li><a href="/items" onclick="toggleMobileMenu()">ITEMS</a></li>
            <li><a href="/#services" onclick="toggleMobileMenu()">SERVICES</a></li>
            <li><a href="/about" onclick="toggleMobileMenu()">ABOUT US</a></li>
            @auth
                <li><a href="{{ route('orders.history') }}" onclick="toggleMobileMenu()">MY ORDERS</a></li>
            @endauth
        </ul>
        <div class="mobile-menu-footer">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="mobile-profile-link" onclick="toggleMobileMenu()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="mobile-profile-link" onclick="toggleMobileMenu()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        Login / Register
                    </a>
                @endauth
            @endif
        </div>
    </div>

    {{ $slot }}

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <a href="/" class="logo">
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" fill="#FF9F43"/>
                        <ellipse cx="12" cy="12" rx="6" ry="3" fill="#1a1a1a"/>
                        <circle cx="10" cy="11" r="1" fill="white"/>
                    </svg>
                    <span>SUSHI</span>
                </a>
                <p>Membawa cita rasa otentik Jepang ke meja makan Anda dengan bahan-bahan pilihan paling segar.</p>
                <div class="social-links">
                    <a href="#" class="social-link" title="Instagram">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="#" class="social-link" title="Twitter">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                    </a>
                    <a href="#" class="social-link" title="Facebook">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                </div>
            </div>
            
            <div class="footer-nav">
                <h4>QUICK LINKS</h4>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/items">Items</a></li>
                    <li><a href="/#services">Services</a></li>
                    <li><a href="/about">About Us</a></li>
                </ul>
            </div>
            
            <div class="footer-app">
                <h4>GET THE APP</h4>
                <div class="app-buttons">
                    <a href="#" class="app-btn">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 13c-.01 0-.01 0 0 0 .58 0 1.1-.31 1.38-.76.35-.55.33-1.22-.05-1.74a2.6 2.6 0 0 0-1.85-1 c-.35 0-.69.09-1.01.26a2.6 2.6 0 0 0-1.39-1.01c-.48-.11-.97-.13-1.46-.06a2.6 2.6 0 0 0-2.3 2.1c-.08.43-.07.88.02 1.33a2.6 2.6 0 0 0 2 2.06c.46.1 1.05.07 1.52-.1a2.6 2.6 0 0 0 1.31.54c.33.06.66.08.99.07 0 0 0 0 0 0v1.7c0 .16.03.32.09.47s.15.28.26.39l2.8 2.8c.4.39 1.04.38 1.43-.01.39-.4.38-1.04-.01-1.43l-2.07-2.07c.4-.39 1.04-.38 1.43-.01.39.4.38 1.04-.01 1.43l.7.7c.39.39 1.02.39 1.41 0s.39-1.02 0-1.41l-.7-.7-.34-.33c-.15-.15-.22-.35-.22-.56v-2.14c0 0 0 0 0 0"></path><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path></svg>
                        App Store
                    </a>
                    <a href="#" class="app-btn">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M3.61 2.05c-.17 0-.34.04-.49.11l10.94 10.94 2.87-2.87L3.99 2.14a1.012 1.012 0 0 0-.38-.09zm11.23 11.23L4.1 23.95c.1.03.2.05.3.05.15 0 .29-.03.43-.09l11.66-6.66-1.65-3.87zm1.65-1.65 3.56 2.04c.48.27.7.81.56 1.31l-2.04-4.8 1.48-1.48c.17.1.32.23.44.4l2.5 2.5a1.012 1.012 0 0 1 0 1.41l-2.5 2.5c-.17.17-.38.28-.6.33L16.49 11.63zM1.5 5.25v13.5c0 .41.34.75.75.75h1.5c.41 0 .75-.34.75-.75V5.25c0-.41-.34-.75-.75-.75h-1.5c-.41 0-.75.34-.75.75z"></path></svg>
                        Google Play
                    </a>
                </div>
            </div>
        </div>
    </footer>

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
    </script>


    @livewireScripts
</body>
</html>
