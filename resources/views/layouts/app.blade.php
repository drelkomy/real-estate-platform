<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
      class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Real Estate Platform') }} | {{ __('Premium Properties') }}</title>

    {{-- Force Light Mode on Public Interface --}}
    <script>
        document.documentElement.classList.remove('dark');
        document.documentElement.classList.add('light');
    </script>

    {{-- Fonts: Cairo & Outfit --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- FontAwesome 6 Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Maps CSS & JS (Local high-performance assets: MapLibre 3D & Leaflet) --}}
    <link rel="stylesheet" href="{{ asset('vendor/maplibre/maplibre-gl.css') }}" />
    <script src="{{ asset('vendor/maplibre/maplibre-gl.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}" />
    <script src="{{ asset('vendor/leaflet/leaflet.js') }}"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Cairo', 'Outfit', sans-serif;
            background-color: #F8FAFC;
            color: #0F172A;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="min-h-screen flex flex-col font-cairo bg-slate-50 text-slate-900 antialiased selection:bg-[#071529] selection:text-[#D4AF37]">

    {{-- 1. Navigation Header (Global Reusable Layout Component) --}}
    @include('components.layouts.header')

    {{-- 2. Main Page Content --}}
    <main class="flex-1">
        {{ $slot }}
    </main>

    {{-- 3. Footer (Global Reusable Layout Component) --}}
    @include('components.layouts.footer')

    @livewireScripts
</body>
</html>
