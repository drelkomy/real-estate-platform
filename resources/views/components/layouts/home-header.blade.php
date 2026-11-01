<header class="sticky top-0 z-50 bg-[#002b66] border-b border-white/10 text-white shadow-md backdrop-blur-md">
    <div class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18">
            
            {{-- Brand Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 text-white no-underline group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#00AEEF] to-[#003580] flex items-center justify-center text-xl shadow-md group-hover:scale-105 transition-transform">
                    🏢
                </div>
                <div>
                    <span class="block font-black text-lg tracking-tight text-white leading-tight">
                        {{ config('app.name', 'Real Estate Platform') }}
                    </span>
                    <span class="block text-[10px] text-cyan-300 font-bold uppercase tracking-wider">
                        {{ __('Modern Real Estate Hub') }}
                    </span>
                </div>
            </a>

            {{-- Main Navigation Links --}}
            <nav class="hidden md:flex items-center gap-1 lg:gap-2">
                <a href="{{ url('/') }}" class="px-3.5 py-2 rounded-xl text-xs lg:text-sm font-bold text-white hover:bg-white/10 transition">
                    {{ __('Home') }}
                </a>
                <a href="#featured-properties" class="px-3.5 py-2 rounded-xl text-xs lg:text-sm font-bold text-slate-200 hover:text-white hover:bg-white/10 transition">
                    {{ __('Properties for Sale') }}
                </a>
                <a href="#featured-properties" class="px-3.5 py-2 rounded-xl text-xs lg:text-sm font-bold text-slate-200 hover:text-white hover:bg-white/10 transition">
                    {{ __('Properties for Rent') }}
                </a>
                <a href="#destinations" class="px-3.5 py-2 rounded-xl text-xs lg:text-sm font-bold text-slate-200 hover:text-white hover:bg-white/10 transition">
                    {{ __('Top Cities') }}
                </a>
            </nav>

            {{-- Auth / Portal Actions --}}
            <div class="flex items-center gap-2 sm:gap-3">
                @auth
                    <a href="{{ route('admin.dashboard') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#00AEEF] hover:bg-[#0096D6] text-white text-xs sm:text-sm font-black shadow-md transition">
                        <i class="fas fa-th-large text-xs"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="w-9 h-9 rounded-xl bg-white/10 hover:bg-rose-500/20 text-white hover:text-rose-300 flex items-center justify-center transition cursor-pointer" 
                                title="{{ __('Logout') }}">
                            <i class="fas fa-sign-out-alt text-xs"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" 
                       class="px-3.5 sm:px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-bold transition">
                        <i class="fas fa-sign-in-alt text-xs me-1"></i>
                        <span>{{ __('Sign In') }}</span>
                    </a>
                    <a href="{{ route('register') }}" 
                       class="inline-flex items-center gap-1.5 px-3.5 sm:px-4 py-2 rounded-xl bg-[#FEBB02] hover:bg-[#E5A800] text-slate-900 text-xs sm:text-sm font-black shadow-md transition">
                        <i class="fas fa-user-plus text-xs"></i>
                        <span>{{ __('Register') }}</span>
                    </a>
                @endauth
            </div>

        </div>
    </div>
</header>

