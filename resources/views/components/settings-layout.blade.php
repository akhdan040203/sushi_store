<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Settings' }} - Sushi Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #0f0f0f; color: #fff; min-height: 100vh; }
        
        .settings-layout {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .settings-header {
            background: #1a1a1a;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .settings-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: white;
        }

        .settings-logo svg { width: 40px; height: 40px; }
        .settings-logo span { font-size: 1.25rem; font-weight: 700; letter-spacing: 2px; }

        .settings-nav {
            display: flex;
            gap: 1rem;
        }

        .settings-nav a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .settings-nav a:hover {
            background: rgba(255,255,255,0.05);
            color: white;
        }

        .settings-content {
            flex: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 3rem 2rem;
            width: 100%;
        }

        .settings-title {
            margin-bottom: 2rem;
        }

        .settings-title h1 {
            font-family: 'Cinzel', serif;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .settings-title p {
            color: rgba(255,255,255,0.5);
        }

        .settings-card {
            background: #1a1a1a;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .settings-card h2 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: white !important;
        }

        .settings-card p {
            color: rgba(255,255,255,0.5) !important;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .settings-card label {
            color: rgba(255,255,255,0.8) !important;
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .settings-card input[type="text"],
        .settings-card input[type="email"],
        .settings-card input[type="password"] {
            background: rgba(255,255,255,0.05) !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            color: white !important;
            border-radius: 12px !important;
            padding: 0.875rem 1rem !important;
            width: 100%;
            margin-bottom: 1rem;
        }

        .settings-card input:focus {
            outline: none;
            border-color: #FF7A00 !important;
        }

        .settings-card button {
            background: linear-gradient(135deg, #FF7A00, #FF9F43) !important;
            border: none !important;
            color: white !important;
            padding: 0.75rem 1.5rem !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            cursor: pointer;
            transition: all 0.2s;
        }

        .settings-card button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255,122,0,0.3);
        }

        .delete-section button {
            background: transparent !important;
            border: 1px solid rgba(239,68,68,0.5) !important;
            color: #EF4444 !important;
        }

        .delete-section button:hover {
            background: #EF4444 !important;
            color: white !important;
        }
    </style>
</head>
<body>
    <div class="settings-layout">
        <header class="settings-header">
            <a href="/" class="settings-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" fill="#FF9F43"/>
                    <ellipse cx="12" cy="12" rx="6" ry="3" fill="#1a1a1a"/>
                    <circle cx="10" cy="11" r="1" fill="white"/>
                </svg>
                <span>SUSHI</span>
            </a>
            <nav class="settings-nav">
                <a href="/">← Back to Store</a>
                @if(auth()->user() && auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}">Admin Dashboard</a>
                @endif
            </nav>
        </header>

        <main class="settings-content">
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>
</html>
