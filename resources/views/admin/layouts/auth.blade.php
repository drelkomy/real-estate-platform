<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? __('Authentication') }} | {{ config('app.name', 'Real Estate Platform') }}</title>

    {{-- Fonts: Cairo & Outfit --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- FontAwesome 6 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        (function() {
            var t = localStorage.getItem('theme');
            if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
        function toggleDarkMode() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }
    </script>

    @livewireStyles
    @include('admin.layouts.ta-components')

    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body { margin: 0; padding: 0; font-family: 'Cairo', 'Outfit', sans-serif; }

        .auth-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
        }
        @media (min-width: 1024px) {
            .auth-wrapper { flex-direction: row; }
        }

        .auth-form-col {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2rem 1.5rem;
            min-height: 100vh;
            background: #FFFFFF;
            z-index: 10;
        }
        html.dark .auth-form-col { background: #0B1120; color: #F1F5F9; }

        @media (min-width: 640px) {
            .auth-form-col { padding: 3rem; }
        }
        @media (min-width: 1024px) {
            .auth-form-col { width: 50%; padding: 4rem; }
        }

        .auth-brand-col {
            display: none;
            width: 50%;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            background: #003580;
            padding: 3rem;
            min-height: 100vh;
            overflow: hidden;
            color: white;
        }
        @media (min-width: 1024px) {
            .auth-brand-col { display: flex; }
        }
        html.dark .auth-brand-col { background: #07152B; }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            font-weight: 700;
            color: #64748B;
            text-decoration: none;
            transition: color 0.2s;
        }
        .back-link:hover { color: #003580; }
        html.dark .back-link:hover { color: #38BDF8; }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950">

    <div class="auth-wrapper">
        
        {{-- ===== Form Column (Left / Right depending on RTL) ===== --}}
        <div class="auth-form-col">
            
            {{-- Top Header / Navigation --}}
            <div style="max-width:480px;width:100%;margin:0 auto 1.5rem;display:flex;align-items:center;justify-content:space-between;">
                <a href="{{ url('/') }}" class="back-link">
                    <i class="fas {{ app()->getLocale() === 'ar' ? 'fa-arrow-right' : 'fa-arrow-left' }}" style="font-size:0.75rem;"></i>
                    <span>{{ __('Back to website') }}</span>
                </a>

                {{-- Dark mode toggle --}}
                <button type="button" onclick="toggleDarkMode()"
                        class="ta-icon-btn cursor-pointer"
                        title="Toggle theme">
                    <i class="fas fa-moon text-xs"></i>
                </button>
            </div>

            {{-- Main Form Slot --}}
            <div style="max-width:480px;width:100%;margin:auto;padding:1rem 0;overflow-y:auto;" class="no-scrollbar">
                {{ $slot }}
            </div>

            {{-- Footer --}}
            <div style="max-width:480px;width:100%;margin:0 auto;text-align:center;font-size:0.75rem;color:#94A3B8;padding-top:1.5rem;">
                &copy; {{ date('Y') }} {{ config('app.name', 'Real Estate Platform') }} &mdash; {{ __('All rights reserved.') }}
            </div>

        </div>

        {{-- ===== Brand Visual Column ===== --}}
        @php
            $isRegisterPage = request()->is('*register*');
            $authTitle = $isRegisterPage ? __('Join Our Premier Real Estate Network') : __('Welcome Back to Your Real Estate Portal');
            $authSubtitle = $isRegisterPage 
                ? __('Create your account to discover luxury properties, manage listings, and connect with top verified brokers.')
                : __('Sign in to access your portfolio, manage viewing appointments, and explore exclusive real estate deals.');
        @endphp
        <div class="auth-brand-col">
            
            {{-- Luxury Architecture Background Image --}}
            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1600&q=80" 
                 alt="Real Estate Platform" 
                 style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; filter:brightness(0.55);">
            
            {{-- Royal Blue Gradient Overlay --}}
            <div style="position:absolute; inset:0; background: linear-gradient(180deg, rgba(0, 53, 128, 0.8) 0%, rgba(15, 23, 42, 0.92) 100%);"></div>

            {{-- Brand Content Box --}}
            <div style="position:relative; z-index:10; display:flex; flex-direction:column; align-items:center; max-width:460px; text-align:center; gap:1.25rem; padding: 2rem;">
                
                {{-- Platform Brand Icon Badge --}}
                <a href="{{ url('/') }}" style="display:inline-flex; align-items:center; justify-content:center; width:72px; height:72px; border-radius:24px; background:rgba(254,187,2,0.2); backdrop-filter:blur(10px); border:2px solid #FEBB02; color:#FEBB02; font-size:2rem; text-decoration:none; box-shadow:0 8px 30px rgba(0,0,0,0.4);">
                    <i class="fas fa-city"></i>
                </a>

                <h2 style="font-size:1.85rem; font-weight:900; color:#ffffff; margin:0; line-height:1.3; text-shadow:0 2px 10px rgba(0,0,0,0.6);">
                    {{ $authTitle }}
                </h2>

                <p style="font-size:0.95rem; color:rgba(255,255,255,0.9); line-height:1.7; margin:0; text-shadow:0 1px 4px rgba(0,0,0,0.6);">
                    {{ $authSubtitle }}
                </p>

                {{-- Feature Badges --}}
                <div style="display:flex; flex-wrap:wrap; align-items:center; justify-content:center; gap:0.75rem; margin-top:1rem;">
                    <span style="display:inline-flex; align-items:center; gap:0.4rem; padding:0.5rem 1rem; background:rgba(255,255,255,0.12); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.25); border-radius:9999px; font-size:0.8rem; color:#ffffff; font-weight:700;">
                        <i class="fas fa-certificate" style="color:#FEBB02;"></i> {{ __('Verified Listings') }}
                    </span>
                    <span style="display:inline-flex; align-items:center; gap:0.4rem; padding:0.5rem 1rem; background:rgba(255,255,255,0.12); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.25); border-radius:9999px; font-size:0.8rem; color:#ffffff; font-weight:700;">
                        <i class="fas fa-shield-alt" style="color:#38BDF8;"></i> {{ __('Bank-Grade Security') }}
                    </span>
                    <span style="display:inline-flex; align-items:center; gap:0.4rem; padding:0.5rem 1rem; background:rgba(255,255,255,0.12); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.25); border-radius:9999px; font-size:0.8rem; color:#ffffff; font-weight:700;">
                        <i class="fas fa-headset" style="color:#34D399;"></i> {{ __('Dedicated Support') }}
                    </span>
                </div>

            </div>

        </div>

    </div>

    @livewireScripts
</body>
</html>
