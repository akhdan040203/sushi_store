<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Settings' }} - Sushi Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/settings.css', 'resources/js/app.js'])
    @livewireStyles
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
