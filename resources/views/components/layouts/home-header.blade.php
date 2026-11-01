<header class="sticky top-0 z-50 bg-[#071529]/95 border-b border-[#D4AF37]/25 text-white shadow-lg backdrop-blur-md">
    <div class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- Brand Logo in Royal Gold & Navy --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3 text-white no-underline group">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-[#AA7C11] via-[#D4AF37] to-[#F3E5AB] text-slate-950 flex items-center justify-center text-xl shadow-md shadow-amber-500/20 group-hover:scale-105 transition-transform duration-300">
                    🏢
                </div>
                <div>
                    <span class="block font-black text-lg tracking-tight text-white leading-tight">
                        {{ config('app.name', 'Real Estate Platform') }}
                    </span>
                    <span class="block text-[10px] text-[#D4AF37] font-black uppercase tracking-wider flex items-center gap-1">
                        <i class="fas fa-crown text-[8px]"></i>
                        <span>{{ __('Luxury Real Estate Hub') }}</span>
                    </span>
                </div>
            </a>

            {{-- Main Navigation Links --}}
            <nav class="hidden md:flex items-center gap-1.5 lg:gap-2">
                <a href="{{ url('/') }}" class="px-4 py-2 rounded-xl text-xs lg:text-sm font-bold text-white hover:text-[#D4AF37] hover:bg-white/5 transition">
                    {{ __('Home') }}
                </a>
                <a href="#featured-properties" class="px-4 py-2 rounded-xl text-xs lg:text-sm font-bold text-slate-300 hover:text-[#D4AF37] hover:bg-white/5 transition">
                    {{ __('Properties for Sale') }}
                </a>
                <a href="#featured-properties" class="px-4 py-2 rounded-xl text-xs lg:text-sm font-bold text-slate-300 hover:text-[#D4AF37] hover:bg-white/5 transition">
                    {{ __('Properties for Rent') }}
                </a>
                <a href="#destinations" class="px-4 py-2 rounded-xl text-xs lg:text-sm font-bold text-slate-300 hover:text-[#D4AF37] hover:bg-white/5 transition">
                    {{ __('Top Cities') }}
                </a>
            </nav>

            {{-- Auth / Portal Actions --}}
            <div class="flex items-center gap-2 sm:gap-3">
                @auth
                    <a href="{{ route('admin.dashboard') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-[#E5C158] via-[#D4AF37] to-[#AA7C11] hover:from-[#F3E5AB] hover:to-[#D4AF37] text-slate-950 text-xs sm:text-sm font-black shadow-md shadow-amber-500/20 transition">
                        <i class="fas fa-th-large text-xs"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="w-9 h-9 rounded-xl bg-white/5 hover:bg-rose-500/20 text-slate-300 hover:text-rose-300 border border-white/10 flex items-center justify-center transition cursor-pointer"
                                title="{{ __('Logout') }}">
                            <i class="fas fa-sign-out-alt text-xs"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="px-3.5 sm:px-4 py-2 rounded-xl bg-white/5 hover:bg-white/10 text-slate-200 hover:text-white border border-white/10 text-xs sm:text-sm font-bold transition">
                        <i class="fas fa-sign-in-alt text-xs me-1 text-[#D4AF37]"></i>
                        <span>{{ __('Sign In') }}</span>
                    </a>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-1.5 px-4 sm:px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#E5C158] via-[#D4AF37] to-[#AA7C11] hover:from-[#F3E5AB] hover:to-[#D4AF37] text-slate-950 text-xs sm:text-sm font-black shadow-md shadow-amber-500/20 transition-all duration-200 transform hover:scale-[1.02]">
                        <i class="fas fa-crown text-xs"></i>
                        <span>{{ __('Register') }}</span>
                    </a>
                @endauth
            </div>

        </div>
    </div>
</header>
