<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Marketplace') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-dark-900">
    <div class="min-h-screen flex flex-col items-center justify-center p-4 relative overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 -left-20 w-96 h-96 bg-accent/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Logo -->
        <div class="relative z-10 mb-8 animate-fade-in">
            <a href="/" class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-accent flex items-center justify-center shadow-glow">
                    <svg class="w-7 h-7 text-dark-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-2xl font-bold text-gradient">MarketHub</span>
            </a>
        </div>

        <!-- Auth Card -->
        <div class="relative z-10 w-full max-w-md animate-slide-up">
            <div class="glass-card p-8">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer Links -->
        <div class="relative z-10 mt-8 text-center text-dark-500 text-sm animate-fade-in">
            <a href="{{ route('marketplace.index') }}" class="hover:text-accent transition-colors">
                Browse Marketplace
            </a>
            <span class="mx-2">•</span>
            <span>&copy; {{ date('Y') }} MarketHub</span>
        </div>
    </div>
</body>
</html>
