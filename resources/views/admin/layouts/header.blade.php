@php 
    $isRtl = app()->getLocale() === 'ar'; 
    $authUser = auth()->user();
@endphp

<header id="ta-header" x-data>
    <div style="display:flex;align-items:center;gap:0.75rem;width:100%;padding:0 1.25rem;">

        {{-- ===== Hamburger Button ===== --}}
        <button class="hamburger-btn"
                @click="$store.sidebar.toggle()"
                aria-label="Toggle Sidebar"
                title="Toggle Sidebar"
                style="width:44px;height:44px;border-radius:12px;background:#ECFDF5;border:1.5px solid #0D9488;color:#064E3B;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px rgba(13,148,136,0.25);transition:all 0.2s;flex-shrink:0;"
                class="dark:bg-[#0D9488]/25 dark:text-[#5EEAD4] dark:border-[#5EEAD4]/40 hover:scale-105 active:scale-95">
            <i class="fas fa-bars" style="font-size:20px;"></i>
        </button>

        {{-- Mobile Logo (hidden on desktop) --}}
        <a href="{{ url('/admin') }}" class="mobile-logo-link lg:hidden font-black text-slate-800 dark:text-white text-lg">
            🏢 {{ config('app.name', 'Real Estate') }}
        </a>

        {{-- Quick Site View Link --}}
        <a href="{{ url('/') }}" target="_blank"
           class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition dark:bg-white/5 dark:text-slate-300 dark:hover:bg-white/10">
            <i class="fas fa-external-link-alt text-[11px] text-[#00AEEF]"></i>
            <span>{{ __('View Website') }}</span>
        </a>

        {{-- ===== Right Actions ===== --}}
        <div style="display:flex;align-items:center;gap:10px;margin-{{ $isRtl ? 'right' : 'left' }}:auto;">

            {{-- Dark Mode Toggle --}}
            <button class="ta-icon-btn flex" @click="$store.theme.toggle()" title="Toggle dark mode">
                <svg x-show="!$store.theme.dark" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
                <svg x-show="$store.theme.dark" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="5"/>
                    <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
                </svg>
            </button>

            {{-- User Profile Dropdown --}}
            <div x-data="{ open: false }" style="position:relative;">
                <button @click="open = !open"
                        style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:4px 8px;border-radius:12px;border:none;background:transparent;"
                        class="hover:bg-slate-100 dark:hover:bg-white/5 transition">
                    <img src="{{ $authUser?->avatar_url ?? 'https://ui-avatars.com/api/?name=Admin&background=003580&color=fff' }}"
                         alt="Avatar"
                         style="width:36px;height:36px;border-radius:9999px;object-fit:cover;border:2px solid #00AEEF;">
                    <div class="hidden sm:block text-start">
                        <p style="font-size:13px;font-weight:700;margin:0;line-height:1.2;" class="text-slate-900 dark:text-white">
                            {{ $authUser?->name ?? 'Admin User' }}
                        </p>
                        <p style="font-size:11px;color:#6B7280;margin:0;" class="dark:text-slate-400">
                            {{ $authUser?->roles->first()?->name ?? 'Administrator' }}
                        </p>
                    </div>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-slate-400">
                        <path d="M6 9l6 6 6-6"/>
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" x-transition class="ta-dropdown" style="width:220px;z-index:100;" x-cloak>
                    <div style="padding:12px 16px;border-bottom:1px solid #F3F4F6;" class="dark:border-white/10">
                        <p style="font-size:13px;font-weight:700;margin:0;" class="text-slate-900 dark:text-white">{{ $authUser?->name }}</p>
                        <p style="font-size:11px;color:#9CA3AF;margin:0;truncate">{{ $authUser?->email }}</p>
                    </div>
                    <div style="padding:6px;">
                        <a href="{{ route('admin.profile') }}" class="ta-dropdown-item">
                            <i class="fas fa-user-circle"></i>
                            {{ __('My Profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="ta-dropdown-item text-red-600 hover:text-red-700 w-full text-start" style="border:none;background:none;">
                                <i class="fas fa-sign-out-alt"></i>
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</header>
