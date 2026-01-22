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

    <style>
        .user-dropdown-container {
            position: relative;
            display: inline-block;
        }

        .profile-toggle-btn {
            background: transparent;
            border: none;
            color: var(--dark-charcoal);
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 0;
            transition: color 0.3s;
        }

        .profile-toggle-btn:hover {
            color: var(--vibrant-orange);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            width: 220px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 0.75rem 0;
            margin-top: 1rem;
            z-index: 1000;
            border: 1px solid rgba(0,0,0,0.05);
        }

        /* Remova o hover CSS que mostrava o menu automaticamente */
        /* .dropdown:hover .dropdown-menu { display: block; } */

        .dropdown-header {
            padding: 0.75rem 1.25rem;
            display: flex;
            flex-direction: column;
        }

        .dropdown-header span {
            font-weight: 600;
            color: var(--dark-charcoal);
            font-size: 0.95rem;
        }

        .dropdown-header small {
            color: #888;
            font-size: 0.75rem;
            background: #eee;
            padding: 2px 8px;
            border-radius: 10px;
            width: fit-content;
            margin-top: 4px;
        }

        .dropdown-divider {
            height: 1px;
            background: #f0f0f0;
            margin: 0.5rem 0;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.25rem;
            color: #555;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s;
            width: 100%;
            border: none;
            background: transparent;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: #f8f8f8;
            color: var(--vibrant-orange);
        }

        .dropdown-item svg {
            width: 18px;
            height: 18px;
        }

        .logout-btn:hover {
            background: #fff5f5;
            color: var(--accent-red);
        }

        /* Triangle pointer */
        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -6px;
            right: 15px;
            width: 12px;
            height: 12px;
            background: white;
            border-left: 1px solid rgba(0,0,0,0.05);
            border-top: 1px solid rgba(0,0,0,0.05);
            transform: rotate(45deg);
        }

        [x-cloak] { display: none !important; }
    </style>
</div>
