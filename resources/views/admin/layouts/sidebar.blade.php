@php $isRtl = app()->getLocale() === 'ar'; @endphp

<aside id="ta-sidebar" data-expanded="true" data-mobile-open="false"
       x-data
       @mouseenter="$store.sidebar.setHover(true)"
       @mouseleave="$store.sidebar.setHover(false)">

    {{-- ===== LOGO ===== --}}
    <div class="logo-wrap" style="padding:1.5rem 1.25rem 1rem;flex-shrink:0;">
        <a href="{{ url('/admin') }}"
           style="display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:14px;background:#003580;box-shadow:0 2px 12px rgba(0,53,128,0.25);"
           class="dark:!bg-white/5 dark:!shadow-none text-white no-underline">
            <span class="text-2xl">🏢</span>
            <div class="sidebar-text flex flex-col min-w-0">
                <span class="font-black text-sm text-white tracking-wide truncate">
                    {{ config('app.name', 'Real Estate Platform') }}
                </span>
                <span class="text-[10px] text-cyan-300 font-bold tracking-wider uppercase">
                    {{ __('Admin Portal') }}
                </span>
            </div>
        </a>
    </div>

    {{-- ===== NAVIGATION LINKS ===== --}}
    <div class="ta-sidebar-nav" style="padding:0.75rem 0.85rem;overflow-y:auto;flex:1;">
        
        {{-- Section: Overview --}}
        <div class="ta-nav-group-title" style="padding:0.5rem 0.75rem 0.25rem;font-size:11px;font-weight:800;color:#94A3B8;text-transform:uppercase;letter-spacing:0.05em;">
            {{ __('Overview') }}
        </div>

        {{-- Dashboard Link --}}
        <a href="{{ route('admin.dashboard') }}"
           class="ta-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large ta-nav-icon"></i>
            <span class="ta-nav-text">{{ __('Dashboard') }}</span>
        </a>

        {{-- Section: Access Control (Users & Roles) --}}
        <div class="ta-nav-group-title" style="margin-top:1.25rem;padding:0.5rem 0.75rem 0.25rem;font-size:11px;font-weight:800;color:#94A3B8;text-transform:uppercase;letter-spacing:0.05em;">
            {{ __('Access Management') }}
        </div>

        {{-- Users Management --}}
        <a href="{{ route('admin.users') }}"
           class="ta-nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="fas fa-users ta-nav-icon"></i>
            <span class="ta-nav-text">{{ __('Users Management') }}</span>
        </a>

        {{-- Roles & Permissions --}}
        <a href="{{ route('admin.roles') }}"
           class="ta-nav-link {{ request()->routeIs('admin.roles*') ? 'active' : '' }}">
            <i class="fas fa-shield-alt ta-nav-icon"></i>
            <span class="ta-nav-text">{{ __('Roles & Permissions') }}</span>
        </a>

        {{-- Section: Account --}}
        <div class="ta-nav-group-title" style="margin-top:1.25rem;padding:0.5rem 0.75rem 0.25rem;font-size:11px;font-weight:800;color:#94A3B8;text-transform:uppercase;letter-spacing:0.05em;">
            {{ __('Account') }}
        </div>

        {{-- Profile --}}
        <a href="{{ route('admin.profile') }}"
           class="ta-nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <i class="fas fa-user-cog ta-nav-icon"></i>
            <span class="ta-nav-text">{{ __('My Profile') }}</span>
        </a>

        {{-- Website Homepage --}}
        <a href="{{ url('/') }}" target="_blank" class="ta-nav-link">
            <i class="fas fa-globe ta-nav-icon"></i>
            <span class="ta-nav-text">{{ __('Visit Website') }}</span>
        </a>

    </div>

    {{-- ===== BOTTOM USER QUICK BAR ===== --}}
    <div style="padding:1rem;border-top:1px solid #E2E8F0;flex-shrink:0;" class="dark:border-white/10">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;">
            <div style="display:flex;align-items:center;gap:10px;min-width:0;">
                <img src="{{ auth()->user()?->avatar_url ?? 'https://ui-avatars.com/api/?name=Admin' }}"
                     alt="Avatar"
                     style="width:34px;height:34px;border-radius:9999px;object-fit:cover;flex-shrink:0;">
                <div class="sidebar-text truncate">
                    <p style="font-size:12px;font-weight:700;margin:0;line-height:1.2;" class="text-slate-900 dark:text-white truncate">
                        {{ auth()->user()?->name ?? 'Admin' }}
                    </p>
                    <p style="font-size:10px;color:#64748B;margin:0;" class="truncate">
                        {{ auth()->user()?->email }}
                    </p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="ta-icon-btn text-red-500 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-500/10 cursor-pointer" 
                        title="{{ __('Logout') }}"
                        style="width:32px;height:32px;border-radius:8px;">
                    <i class="fas fa-power-off text-xs"></i>
                </button>
            </form>
        </div>
    </div>

</aside>
