<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sushi Store') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cinzel:wght@400;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --vibrant-orange: #FF7A00;
                --soft-cream: #FDF5E6;
                --dark-charcoal: #1A1A1A;
            }

            body {
                font-family: 'Inter', sans-serif;
                background-color: #0f0f0f;
                background-image: 
                    radial-gradient(circle at 10% 20%, rgba(255, 122, 0, 0.05) 0%, transparent 40%),
                    radial-gradient(circle at 90% 80%, rgba(255, 122, 0, 0.05) 0%, transparent 40%);
                color: white;
                margin: 0;
            }

            .auth-container {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2rem;
            }

            .auth-logo {
                margin-bottom: 2.5rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-decoration: none;
            }

            .auth-logo svg {
                width: 60px;
                height: 60px;
                margin-bottom: 1rem;
            }

            .auth-logo span {
                font-family: 'Cinzel', serif;
                font-size: 2rem;
                font-weight: 700;
                letter-spacing: 4px;
                color: white;
            }

            .auth-card {
                width: 100%;
                max-width: 450px;
                background: rgba(26, 26, 26, 0.7);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.05);
                border-radius: 30px;
                padding: 3rem 2.5rem;
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            }

            .auth-title {
                font-family: 'Cinzel', serif;
                font-size: 1.75rem;
                margin-bottom: 0.5rem;
                text-align: center;
            }

            .auth-subtitle {
                color: rgba(255, 255, 255, 0.5);
                text-align: center;
                margin-bottom: 2.5rem;
                font-size: 0.9rem;
            }

            /* Reuse Admin Styles for Inputs */
            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 500;
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
            }

            .form-input {
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: white;
                padding: 1rem 1.25rem;
                border-radius: 15px;
                width: 100%;
                font-size: 0.95rem;
                transition: all 0.3s;
                box-sizing: border-box;
            }

            .form-input:focus {
                outline: none;
                border-color: var(--vibrant-orange);
                background: rgba(255, 255, 255, 0.1);
                box-shadow: 0 0 0 4px rgba(255, 122, 0, 0.1);
            }

            .btn-auth {
                width: 100%;
                background: linear-gradient(135deg, #FF7A00, #FF9F43);
                color: white;
                padding: 1rem;
                border-radius: 15px;
                border: none;
                font-size: 1rem;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.3s;
                margin-top: 1rem;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .btn-auth:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 20px rgba(255, 122, 0, 0.3);
            }

            .auth-footer {
                margin-top: 2rem;
                text-align: center;
                color: rgba(255, 255, 255, 0.5);
                font-size: 0.9rem;
            }

            .auth-footer a {
                color: var(--vibrant-orange);
                text-decoration: none;
                font-weight: 600;
            }

            .auth-footer a:hover {
                text-decoration: underline;
            }

            .error-message {
                color: #EF4444;
                font-size: 0.8rem;
                margin-top: 0.5rem;
            }
        </style>
    </head>
    <body>
        <div class="auth-container">
            <a href="/" class="auth-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" fill="#FF9F43"/>
                    <ellipse cx="12" cy="12" rx="6" ry="3" fill="#1a1a1a"/>
                    <circle cx="10" cy="11" r="1" fill="white"/>
                </svg>
                <span>SUSHI</span>
            </a>

            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
