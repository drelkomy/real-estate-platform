@php
    $headerLocale = app()->getLocale();
    $headerIsRtl = $headerLocale === 'ar';
@endphp

{{-- ===== Reusable Global Navigation Header (Inspired by Official Real Estate Portals) ===== --}}
<header class="sticky top-0 z-50 bg-white border-b border-gray-200/90 text-slate-900 shadow-xs font-cairo"
        dir="{{ $headerIsRtl ? 'rtl' : 'ltr' }}"
        x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18">

            {{-- Right: Official Brand Logo & Identity --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3 no-underline group shrink-0">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#071529] via-[#0A1B33] to-[#D4AF37] text-white flex items-center justify-center text-lg shadow-sm group-hover:scale-105 transition-transform">
                    🏢
                </div>
                <div>
                    <span class="block font-black text-base sm:text-lg tracking-tight text-slate-900 leading-tight">
                        {{ config('app.name', 'Real Estate Platform') }}
                    </span>
                    <span class="block text-[10px] text-[#AA7C11] font-bold uppercase tracking-wider flex items-center gap-1">
                        <i class="fas fa-crown text-[8px] text-[#D4AF37]"></i>
                        <span>{{ __('nav.brand_hub') }}</span>
                    </span>
                </div>
            </a>

            {{-- Center: Clean Official Navigation Links --}}
            <nav class="hidden lg:flex items-center gap-8">
                <a href="#featured-properties"
                   class="text-sm font-bold text-slate-700 hover:text-[#AA7C11] transition-colors py-1 hover:underline underline-offset-4 decoration-2 decoration-[#D4AF37]">
                    {{ __('nav.buy') }}
                </a>
                <a href="#featured-properties"
                   class="text-sm font-bold text-slate-700 hover:text-[#AA7C11] transition-colors py-1 hover:underline underline-offset-4 decoration-2 decoration-[#D4AF37]">
                    {{ __('nav.rent') }}
                </a>
                <a href="#categories"
                   class="text-sm font-bold text-slate-700 hover:text-[#AA7C11] transition-colors py-1 hover:underline underline-offset-4 decoration-2 decoration-[#D4AF37]">
                    {{ __('nav.property_types') }}
                </a>
                <a href="#destinations"
                   class="text-sm font-bold text-slate-700 hover:text-[#AA7C11] transition-colors py-1 hover:underline underline-offset-4 decoration-2 decoration-[#D4AF37]">
                    {{ __('nav.top_cities') }}
                </a>
                <a href="#vip-alerts"
                   class="text-sm font-bold text-slate-700 hover:text-[#AA7C11] transition-colors py-1 hover:underline underline-offset-4 decoration-2 decoration-[#D4AF37]">
                    {{ __('nav.mortgage') }}
                </a>
            </nav>

            {{-- Left: Interactive Actions, Icons Bar & Auth --}}
            <div class="hidden sm:flex items-center gap-1 sm:gap-2">

                {{-- 1. Notifications Icon --}}
                <button type="button"
                        class="p-2 text-slate-600 hover:text-[#071529] hover:bg-slate-100 rounded-lg transition cursor-pointer relative"
                        title="{{ __('nav.notifications') }}">
                    <i class="far fa-bell text-base"></i>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-amber-500 rounded-full"></span>
                </button>

                {{-- Divider --}}
                <span class="text-slate-300 select-none">|</span>

                {{-- 2. Favorites Icon --}}
                <button type="button"
                        class="p-2 text-slate-600 hover:text-rose-600 hover:bg-slate-100 rounded-lg transition cursor-pointer"
                        title="{{ __('nav.favorites') }}">
                    <i class="far fa-heart text-base"></i>
                </button>

                {{-- Divider --}}
                <span class="text-slate-300 select-none">|</span>

                {{-- 3. Compare Properties Icon --}}
                <button type="button"
                        class="p-2 text-slate-600 hover:text-[#071529] hover:bg-slate-100 rounded-lg transition cursor-pointer"
                        title="{{ __('nav.compare') }}">
                    <i class="fas fa-exchange-alt text-sm"></i>
                </button>

                {{-- Divider --}}
                <span class="text-slate-300 select-none">|</span>

                {{-- 4. User Account / Auth Actions --}}
                @auth
                    <a href="{{ route('admin.dashboard') }}"
                       class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold transition">
                        <i class="fas fa-th-large text-[#AA7C11]"></i>
                        <span>{{ __('nav.dashboard') }}</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition cursor-pointer"
                                title="{{ __('nav.logout') }}">
                            <i class="fas fa-sign-out-alt text-sm"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="p-2 text-slate-600 hover:text-[#071529] hover:bg-slate-100 rounded-lg transition cursor-pointer flex items-center gap-1"
                       title="{{ __('nav.sign_in') }}">
                        <i class="far fa-user text-base"></i>
                        <span class="text-xs font-bold hidden md:inline">{{ __('nav.sign_in') }}</span>
                    </a>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg bg-[#071529] hover:bg-[#0A1B33] text-[#D4AF37] hover:text-[#F3E5AB] text-xs font-black shadow-xs transition">
                        <span>{{ __('nav.register') }}</span>
                    </a>
                @endauth

                {{-- Divider --}}
                <span class="text-slate-300 select-none">|</span>

                {{-- 5. Language Switcher (Globe + Language) --}}
                <div class="flex items-center gap-1 px-2 py-1 text-xs font-bold text-slate-700 hover:text-slate-900 cursor-pointer select-none">
                    <i class="fas fa-globe text-slate-500 text-xs"></i>
                    <span>{{ __('nav.current_language') }}</span>
                    <i class="fas fa-chevron-down text-[9px] text-slate-400"></i>
                </div>

            </div>

            {{-- Mobile Menu Trigger Button --}}
            <div class="flex lg:hidden items-center gap-2">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="p-2 text-slate-700">
                        <i class="fas fa-th-large"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="p-2 text-slate-700">
                        <i class="far fa-user"></i>
                    </a>
                @endauth

                <button type="button"
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="p-2 rounded-lg text-slate-700 hover:bg-slate-100 transition cursor-pointer"
                        aria-label="Toggle Menu">
                    <i class="fas fa-bars text-lg" x-show="!mobileMenuOpen"></i>
                    <i class="fas fa-times text-lg" x-show="mobileMenuOpen" x-cloak></i>
                </button>
            </div>

        </div>
    </div>

    {{-- Mobile Navigation Dropdown --}}
    <div x-show="mobileMenuOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden border-t border-slate-200 bg-white px-4 py-4 space-y-2 shadow-lg">
        <a href="#featured-properties" @click="mobileMenuOpen = false" class="block py-2 text-sm font-bold text-slate-800 hover:text-[#AA7C11] border-b border-slate-100">
            {{ __('nav.buy') }}
        </a>
        <a href="#featured-properties" @click="mobileMenuOpen = false" class="block py-2 text-sm font-bold text-slate-800 hover:text-[#AA7C11] border-b border-slate-100">
            {{ __('nav.rent') }}
        </a>
        <a href="#categories" @click="mobileMenuOpen = false" class="block py-2 text-sm font-bold text-slate-800 hover:text-[#AA7C11] border-b border-slate-100">
            {{ __('nav.property_types') }}
        </a>
        <a href="#destinations" @click="mobileMenuOpen = false" class="block py-2 text-sm font-bold text-slate-800 hover:text-[#AA7C11] border-b border-slate-100">
            {{ __('nav.top_cities') }}
        </a>
        <a href="#vip-alerts" @click="mobileMenuOpen = false" class="block py-2 text-sm font-bold text-slate-800 hover:text-[#AA7C11]">
            {{ __('nav.mortgage') }}
        </a>
        <div class="pt-2 border-t border-slate-200 flex items-center justify-between">
            <span class="text-xs text-slate-500 font-bold">{{ __('nav.language_label') }}</span>
            @guest
                <a href="{{ route('register') }}" class="px-3 py-1.5 rounded-lg bg-[#071529] text-[#D4AF37] text-xs font-black">
                    {{ __('nav.register') }}
                </a>
            @endguest
        </div>
    </div>
</header>
