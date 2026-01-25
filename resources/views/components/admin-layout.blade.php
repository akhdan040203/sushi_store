<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} - Sushi Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #0f0f0f; color: #fff; min-height: 100vh; overflow-x: hidden; }
        .admin-layout { display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar { 
            width: 280px; 
            background: #1a1a1a; 
            border-right: 1px solid rgba(255,255,255,0.05); 
            padding: 2rem 0; 
            position: fixed; 
            height: 100vh; 
            overflow-y: auto; 
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-header { padding: 0 1.5rem 2rem; border-bottom: 1px solid rgba(255,255,255,0.05); margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; }
        .sidebar-logo { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; color: white; }
        .sidebar-logo svg { width: 40px; height: 40px; }
        .sidebar-logo span { font-size: 1.5rem; font-weight: 700; letter-spacing: 2px; }
        .sidebar-nav { padding: 0 1rem; }
        .nav-section { margin-bottom: 2rem; }
        .nav-section-title { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.4); padding: 0 0.75rem; margin-bottom: 0.75rem; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.875rem 1rem; border-radius: 12px; color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.2s; margin-bottom: 0.25rem; }
        .nav-item:hover { background: rgba(255,255,255,0.05); color: white; }
        .nav-item.active { background: linear-gradient(135deg, #FF7A00, #FF9F43); color: white; box-shadow: 0 4px 15px rgba(255,122,0,0.3); }
        .nav-item svg { width: 20px; height: 20px; }
        .nav-item span { font-size: 0.9rem; font-weight: 500; }
        
        /* Main Content */
        .main-content { flex: 1; margin-left: 280px; padding: 2rem; transition: margin-left 0.3s ease-in-out; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; gap: 1rem; }
        .page-title h1 { font-size: clamp(1.25rem, 5vw, 1.75rem); font-weight: 600; margin-bottom: 0.25rem; }
        .page-title p { color: rgba(255,255,255,0.5); font-size: 0.9rem; }
        .user-avatar { width: 45px; height: 45px; border-radius: 12px; background: linear-gradient(135deg, #FF7A00, #FF9F43); display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 1.1rem; flex-shrink: 0; }
        
        /* Mobile Toggle */
        .mobile-toggle { display: none; background: #1a1a1a; border: 1px solid rgba(255,255,255,0.1); color: white; padding: 0.5rem; border-radius: 8px; cursor: pointer; }
        .overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 999; }
        
        /* Cards & Tables */
        .admin-card { background: #1a1a1a; border-radius: 20px; padding: 1.5rem; border: 1px solid rgba(255,255,255,0.05); overflow: hidden; }
        .admin-table-container { overflow-x: auto; margin: 0 -1.5rem; padding: 0 1.5rem; }
        .admin-table { width: 100%; border-collapse: collapse; white-space: nowrap; }
        .admin-table th { text-align: left; padding: 1rem; color: rgba(255,255,255,0.5); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 500; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .admin-table td { padding: 1rem; border-bottom: 1px solid rgba(255,255,255,0.03); font-size: 0.9rem; }
        .admin-table tbody tr:hover { background: rgba(255,255,255,0.02); }
        
        /* Buttons */
        .btn-primary { background: linear-gradient(135deg, #FF7A00, #FF9F43); color: white; padding: 0.75rem 1.5rem; border-radius: 12px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; border: none; cursor: pointer; white-space: nowrap; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 20px rgba(255,122,0,0.3); }
        .btn-secondary { background: rgba(255,255,255,0.05); color: white; padding: 0.75rem 1.5rem; border-radius: 12px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; border: 1px solid rgba(255,255,255,0.1); white-space: nowrap; }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 1.5rem; }
            .mobile-toggle { display: flex; }
            .overlay.open { display: block; }
        }
        
        @media (max-width: 640px) {
            .top-bar { flex-direction: column; align-items: flex-start; }
            .top-bar .user-info { display: none; }
            .admin-card { padding: 1rem; }
        }
    </style>
</head>
<body>
    <div class="overlay" id="overlay"></div>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="/" class="sidebar-logo">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" fill="#FF9F43"/>
                        <ellipse cx="12" cy="12" rx="6" ry="3" fill="#1a1a1a"/>
                        <circle cx="10" cy="11" r="1" fill="white"/>
                    </svg>
                    <span>SUSHI</span>
                </a>
                <button class="mobile-toggle" style="background: transparent; border: none;" id="closeSidebar">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <p class="nav-section-title">Main Menu</p>
                    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1" stroke-width="2"/><rect x="14" y="3" width="7" height="7" rx="1" stroke-width="2"/><rect x="3" y="14" width="7" height="7" rx="1" stroke-width="2"/><rect x="14" y="14" width="7" height="7" rx="1" stroke-width="2"/></svg>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="nav-section">
                    <p class="nav-section-title">Management</p>
                    <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span>Products</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        <span>Categories</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        <span>Orders</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>Users</span>
                    </a>
                    <a href="{{ route('admin.broadcast') }}" class="nav-item {{ request()->routeIs('admin.broadcast') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.297A1.708 1.708 0 019.293 21H5.414a1.708 1.708 0 01-1.707-1.707V5.882a1.708 1.708 0 011.708-1.707h3.879a1.708 1.708 0 011.707 1.707zM19.297 5.882v13.415A1.708 1.708 0 0117.586 21H13.71a1.708 1.708 0 01-1.707-1.707V5.882a1.708 1.708 0 011.708-1.707h3.879a1.708 1.708 0 011.707 1.707zM11 5.882h8.297"></path>
                        </svg>
                        <span>Broadcast</span>
                    </a>
                </div>


                <div class="nav-section">
                    <p class="nav-section-title">Settings</p>
                    <a href="{{ route('profile') }}" class="nav-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Settings</span>
                    </a>
                    <a href="/" class="nav-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        <span>View Store</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="top-bar-mobile" style="display: none; justify-content: space-between; align-items: center; margin-bottom: 2rem;" id="mobileHeader">
                <button class="mobile-toggle" id="openSidebar">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
            </div>
            {{ $slot }}
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const openBtn = document.getElementById('openSidebar');
        const closeBtn = document.getElementById('closeSidebar');
        const mobileHeader = document.getElementById('mobileHeader');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        }

        if(openBtn) openBtn.addEventListener('click', toggleSidebar);
        if(closeBtn) closeBtn.addEventListener('click', toggleSidebar);
        if(overlay) overlay.addEventListener('click', toggleSidebar);

        // Handle mobile header visibility
        function checkMobile() {
            if (window.innerWidth <= 1024) {
                mobileHeader.style.display = 'flex';
            } else {
                mobileHeader.style.display = 'none';
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
            }
        }

        window.addEventListener('resize', checkMobile);
        checkMobile();
    </script>
@livewireScripts
</body>
</html>
