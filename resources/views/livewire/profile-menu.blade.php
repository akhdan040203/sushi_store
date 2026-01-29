<div class="user-dropdown-container" x-data="{ open: false }" @click.away="open = false">
    @auth
        <div class="dropdown">
            <button @click="open = !open" class="profile-toggle-btn" title="{{ Auth::user()->name }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </button>
            <div class="dropdown-menu" x-show="open" style="display: block;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="dropdown-header">
                    <span>{{ Auth::user()->name }}</span>
                    <small>{{ ucfirst(Auth::user()->role) }}</small>
                </div>
                <div class="dropdown-divider"></div>
                
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('dashboard') }}" wire:navigate class="dropdown-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/></svg>
                        Admin Dashboard
                    </a>
                @endif

                <a href="{{ route('profile') }}" wire:navigate class="dropdown-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Profile Settings
                </a>

                <div class="dropdown-divider"></div>
                
                <button wire:click="logout" class="dropdown-item logout-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Logout
                </button>
            </div>
        </div>
    @else
        <a href="{{ route('login') }}" title="Login" class="profile-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </a>
    @endauth

    @vite(['resources/css/profile-menu.css'])
</div>
