<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    {{-- Theme detection script before render --}}
    <script>
        (function() {
            var t = localStorage.getItem('theme');
            if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? __('Admin Dashboard') }} | {{ config('app.name', 'Real Estate Platform') }}</title>

    {{-- Fonts: Cairo & Outfit --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- FontAwesome 6 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Tailwind CSS CDN & darkMode config --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @include('admin.layouts.ta-components')

    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; height: 100%; }

        body {
            font-family: 'Cairo', 'Outfit', sans-serif;
            background: #F8FAFC;
            color: #0F172A;
            overflow-x: hidden;
        }
        html.dark body { background: #0B1120; color: #F1F5F9; }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Sidebar styles */
        #ta-sidebar {
            width: 270px;
            background: #FFFFFF;
            border-inline-end: 1px solid #E2E8F0;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            inset-inline-start: 0;
            z-index: 50;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        html.dark #ta-sidebar {
            background: #0F172A;
            border-inline-end-color: rgba(255,255,255,0.08);
        }

        #ta-header {
            height: 70px;
            background: #FFFFFF;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 40;
        }
        html.dark #ta-header {
            background: #0F172A;
            border-bottom-color: rgba(255,255,255,0.08);
        }

        .main-wrapper {
            margin-inline-start: 270px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-inline-start 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (max-width: 1023px) {
            #ta-sidebar {
                transform: translateX({{ app()->getLocale() === 'ar' ? '100%' : '-100%' }});
            }
            #ta-sidebar.mobile-open {
                transform: translateX(0);
            }
            .main-wrapper {
                margin-inline-start: 0 !important;
            }
        }

        .ta-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 12px;
            color: #475569;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-bottom: 4px;
        }
        html.dark .ta-nav-link { color: #94A3B8; }
        .ta-nav-link:hover {
            background: #F1F5F9;
            color: #003580;
        }
        html.dark .ta-nav-link:hover {
            background: rgba(255,255,255,0.05);
            color: #38BDF8;
        }
        .ta-nav-link.active {
            background: #003580;
            color: #FFFFFF !important;
            box-shadow: 0 4px 12px rgba(0,53,128,0.25);
        }
        html.dark .ta-nav-link.active {
            background: #0284C7;
            box-shadow: 0 4px 12px rgba(2,132,199,0.3);
        }
        .ta-nav-icon {
            font-size: 15px;
            width: 20px;
            text-align: center;
        }

        .ta-icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid #E2E8F0;
            background: #FFFFFF;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        html.dark .ta-icon-btn {
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.1);
            color: #CBD5E1;
        }
        .ta-icon-btn:hover {
            background: #F1F5F9;
            color: #0F172A;
        }

        .ta-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            inset-inline-end: 0;
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 14px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        html.dark .ta-dropdown {
            background: #1E293B;
            border-color: rgba(255,255,255,0.1);
        }
        .ta-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.15s;
        }
        html.dark .ta-dropdown-item { color: #CBD5E1; }
        .ta-dropdown-item:hover {
            background: #F1F5F9;
            color: #003580;
        }
        html.dark .ta-dropdown-item:hover {
            background: rgba(255,255,255,0.06);
            color: #38BDF8;
        }

        #ta-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(2px);
            z-index: 45;
        }
        #ta-backdrop.active { display: block; }
    </style>
</head>
<body>

    {{-- Mobile Backdrop --}}
    <div id="ta-backdrop" onclick="Alpine.store('sidebar').closeMobile()"></div>

    {{-- Sidebar --}}
    @include('admin.layouts.sidebar')

    {{-- Main Wrapper --}}
    <div class="main-wrapper" id="main-wrapper">
        {{-- Header --}}
        @include('admin.layouts.header')

        {{-- Main Page Content --}}
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        @include('admin.layouts.footer')
    </div>

    {{-- Alpine Stores & Initialization --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('sidebar', {
                mobileOpen: false,
                toggle() {
                    this.mobileOpen = !this.mobileOpen;
                    this.sync();
                },
                closeMobile() {
                    this.mobileOpen = false;
                    this.sync();
                },
                setHover() {},
                sync() {
                    const sb = document.getElementById('ta-sidebar');
                    const bd = document.getElementById('ta-backdrop');
                    if (this.mobileOpen) {
                        sb.classList.add('mobile-open');
                        bd.classList.add('active');
                    } else {
                        sb.classList.remove('mobile-open');
                        bd.classList.remove('active');
                    }
                }
            });

            Alpine.store('theme', {
                dark: document.documentElement.classList.contains('dark'),
                toggle() {
                    this.dark = !this.dark;
                    if (this.dark) {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    }
                }
            });
        });
    </script>

    @livewireScripts
</body>
</html>

