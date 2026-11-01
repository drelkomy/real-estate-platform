<div>
    {{-- Breadcrumb --}}
    <x-admin.breadcrumb :items="[
        ['label' => __('Dashboard'), 'url' => '']
    ]" />

    {{-- Welcome Banner --}}
    <div class="mb-6 p-6 rounded-2xl bg-gradient-to-r from-[#003580] via-[#002860] to-[#001f4d] text-white shadow-lg relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-cyan-200 text-xs font-bold mb-2 backdrop-blur-xs">
                    <i class="fas fa-building text-[#00AEEF]"></i>
                    {{ config('app.name', 'Real Estate Platform') }}
                </span>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight">
                    {{ __('Welcome back, :name!', ['name' => auth()->user()->name]) }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-200 mt-1">
                    {{ __('Manage platform users, roles, permissions, and monitor recent account activity.') }}
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.users') }}" class="ta-btn ta-btn-md ta-btn-primary shadow-md">
                    <i class="fas fa-user-plus"></i>
                    <span>{{ __('Manage Users') }}</span>
                </a>
                <a href="{{ route('admin.roles') }}" class="ta-btn ta-btn-md ta-btn-secondary bg-white/10 hover:bg-white/20 text-white border-white/20">
                    <i class="fas fa-shield-alt"></i>
                    <span>{{ __('Roles') }}</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Stats Cards Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-8">
        {{-- Card 1: Total Users --}}
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">{{ __('Total Users') }}</p>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white">{{ number_format($totalUsers) }}</h3>
                <span class="text-[11px] text-emerald-600 font-bold mt-1 inline-flex items-center gap-1">
                    <i class="fas fa-check-circle text-[10px]"></i> {{ __('Active Accounts') }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xl">
                <i class="fas fa-users"></i>
            </div>
        </div>

        {{-- Card 2: Real Estate Agents --}}
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">{{ __('Licensed Agents') }}</p>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white">{{ number_format($totalAgents) }}</h3>
                <span class="text-[11px] text-cyan-600 font-bold mt-1 inline-flex items-center gap-1">
                    <i class="fas fa-id-badge text-[10px]"></i> {{ __('Verified Brokers') }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center text-xl">
                <i class="fas fa-user-tie"></i>
            </div>
        </div>

        {{-- Card 3: Registered Clients --}}
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">{{ __('Clients & Buyers') }}</p>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white">{{ number_format($totalClients) }}</h3>
                <span class="text-[11px] text-amber-600 font-bold mt-1 inline-flex items-center gap-1">
                    <i class="fas fa-user-check text-[10px]"></i> {{ __('Active Seekers') }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl">
                <i class="fas fa-user-tag"></i>
            </div>
        </div>

        {{-- Card 4: Access Roles --}}
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">{{ __('System Roles') }}</p>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white">{{ number_format($totalRoles) }}</h3>
                <span class="text-[11px] text-purple-600 font-bold mt-1 inline-flex items-center gap-1">
                    <i class="fas fa-shield-alt text-[10px]"></i> {{ __('RBAC Enabled') }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xl">
                <i class="fas fa-lock"></i>
            </div>
        </div>
    </div>

    {{-- Recent Users Table Section --}}
    <div class="ta-table-wrap">
        <div class="p-4 sm:p-5 flex items-center justify-between border-b border-slate-200 dark:border-slate-800">
            <div>
                <h2 class="text-base font-black text-slate-900 dark:text-white">{{ __('Recently Registered Users') }}</h2>
                <p class="text-xs text-slate-500">{{ __('Latest members registered on the platform') }}</p>
            </div>
            <a href="{{ route('admin.users') }}" class="ta-btn ta-btn-sm ta-btn-outline">
                <span>{{ __('View All Users') }}</span>
                <i class="fas {{ app()->getLocale() === 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }} text-xs"></i>
            </a>
        </div>

        <div class="ta-table-scroll">
            <table class="ta-table">
                <thead>
                    <tr>
                        <th class="text-start">{{ __('User') }}</th>
                        <th class="text-start">{{ __('Role') }}</th>
                        <th class="text-start">{{ __('Phone') }}</th>
                        <th class="text-center">{{ __('Status') }}</th>
                        <th class="text-start">{{ __('Joined Date') }}</th>
                        <th class="text-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentUsers as $user)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-9 h-9 rounded-full object-cover">
                                    <div>
                                        <p class="font-bold text-sm text-slate-900 dark:text-white">{{ $user->name }}</p>
                                        <p class="text-xs text-slate-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="ta-badge {{ $role->name === 'super-admin' ? 'ta-badge-error' : ($role->name === 'agent' ? 'ta-badge-info' : 'ta-badge-light') }}">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="text-xs font-mono text-slate-600 dark:text-slate-400">
                                {{ $user->phone ?: '—' }}
                            </td>
                            <td class="text-center">
                                @if($user->is_active)
                                    <span class="ta-badge ta-badge-success">{{ __('Active') }}</span>
                                @else
                                    <span class="ta-badge ta-badge-error">{{ __('Inactive') }}</span>
                                @endif
                            </td>
                            <td class="text-xs text-slate-500">
                                {{ $user->created_at?->format('Y-m-d H:i') }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.users') }}" class="ta-btn ta-btn-sm ta-btn-edit">
                                    <i class="fas fa-edit"></i>
                                    <span>{{ __('View') }}</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-slate-500">
                                {{ __('No registered users found.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

