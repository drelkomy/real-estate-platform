<div>
    {{-- Breadcrumb --}}
    <x-admin.breadcrumb :items="[
        ['label' => __('Dashboard'), 'url' => route('admin.dashboard')],
        ['label' => __('Users Management'), 'url' => '']
    ]" />

    {{-- Top Action & Filter Bar --}}
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">{{ __('Users Management') }}</h1>
            <p class="text-xs text-slate-500 mt-1">{{ __('Manage platform administrators, licensed agents, and registered buyers.') }}</p>
        </div>
        <button type="button" wire:click="openCreateModal" class="ta-btn ta-btn-md ta-btn-primary shadow-sm cursor-pointer self-start sm:self-auto">
            <i class="fas fa-plus"></i>
            <span>{{ __('Add New User') }}</span>
        </button>
    </div>

    {{-- Flash Notifications --}}
    @if(session()->has('success'))
        <div class="mb-4 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-xs sm:text-sm font-bold flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" wire:click="$refresh" class="text-emerald-700 hover:text-emerald-900"><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="mb-4 p-4 rounded-xl bg-rose-50 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/20 text-rose-700 dark:text-rose-400 text-xs sm:text-sm font-bold flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
            <button type="button" wire:click="$refresh" class="text-rose-700 hover:text-rose-900"><i class="fas fa-times"></i></button>
        </div>
    @endif

    {{-- Filter Card --}}
    <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            {{-- Search Bar --}}
            <div class="relative">
                <i class="fas fa-search absolute inset-y-0 start-3.5 flex items-center text-slate-400 text-xs pointer-events-none"></i>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="{{ __('Search by name, email or phone...') }}" 
                       class="w-full h-10 ps-9 pe-4 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-xs font-medium text-slate-900 dark:text-white outline-none focus:border-[#003580] focus:bg-white transition">
            </div>

            {{-- Role Filter --}}
            <div>
                <select wire:model.live="roleFilter" 
                        class="w-full h-10 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-xs font-bold text-slate-800 dark:text-slate-200 outline-none focus:border-[#003580] cursor-pointer">
                    <option value="">{{ __('All Roles') }}</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->name }}">{{ $r->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Status Filter --}}
            <div>
                <select wire:model.live="statusFilter" 
                        class="w-full h-10 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-xs font-bold text-slate-800 dark:text-slate-200 outline-none focus:border-[#003580] cursor-pointer">
                    <option value="">{{ __('All Statuses') }}</option>
                    <option value="1">{{ __('Active') }}</option>
                    <option value="0">{{ __('Inactive') }}</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Users Table --}}
    <div class="ta-table-wrap">
        <div class="ta-table-scroll">
            <table class="ta-table">
                <thead>
                    <tr>
                        <th class="text-start">{{ __('User Details') }}</th>
                        <th class="text-start">{{ __('Role') }}</th>
                        <th class="text-start">{{ __('Phone') }}</th>
                        <th class="text-center">{{ __('Status') }}</th>
                        <th class="text-start">{{ __('Created') }}</th>
                        <th class="text-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover shrink-0">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <p class="font-bold text-sm text-slate-900 dark:text-white">{{ $user->name }}</p>
                                            @if($user->id === auth()->id())
                                                <span class="text-[10px] bg-blue-100 text-blue-800 px-1.5 py-0.2 rounded font-bold">{{ __('You') }}</span>
                                            @endif
                                        </div>
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
                                <button type="button" 
                                        wire:click="toggleStatus({{ $user->id }})"
                                        class="cursor-pointer transition"
                                        title="{{ __('Click to toggle active status') }}">
                                    @if($user->is_active)
                                        <span class="ta-badge ta-badge-success hover:opacity-80">
                                            <i class="fas fa-check text-[10px]"></i> {{ __('Active') }}
                                        </span>
                                    @else
                                        <span class="ta-badge ta-badge-error hover:opacity-80">
                                            <i class="fas fa-times text-[10px]"></i> {{ __('Inactive') }}
                                        </span>
                                    @endif
                                </button>
                            </td>
                            <td class="text-xs text-slate-500">
                                {{ $user->created_at?->format('Y-m-d') }}
                            </td>
                            <td class="text-center">
                                <div class="inline-flex items-center gap-1.5">
                                    <button type="button" 
                                            wire:click="openEditModal({{ $user->id }})" 
                                            class="ta-btn ta-btn-sm ta-btn-edit cursor-pointer" 
                                            title="{{ __('Edit User') }}">
                                        <i class="fas fa-edit"></i>
                                        <span>{{ __('Edit') }}</span>
                                    </button>
                                    @if($user->id !== auth()->id() && !$user->hasRole('super-admin'))
                                        <button type="button" 
                                                wire:click="confirmDelete({{ $user->id }})" 
                                                class="ta-btn ta-btn-sm ta-btn-delete cursor-pointer" 
                                                title="{{ __('Delete User') }}">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>{{ __('Delete') }}</span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-10 text-slate-500">
                                <i class="fas fa-users-slash text-3xl mb-2 block text-slate-300"></i>
                                {{ __('No users matching current criteria.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $users->links('livewire.admin.pagination') }}
        </div>
    </div>

    {{-- Create / Edit Modal --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-xs">
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 w-full max-w-lg overflow-hidden flex flex-col max-h-[90vh]">
                
                {{-- Modal Header --}}
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                    <h3 class="font-black text-base text-slate-900 dark:text-white">
                        {{ $isEditing ? __('Edit User: :name', ['name' => $name]) : __('Add New User') }}
                    </h3>
                    <button type="button" wire:click="$set('showModal', false)" class="text-slate-400 hover:text-slate-700 dark:hover:text-white cursor-pointer">
                        <i class="fas fa-times text-base"></i>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="p-6 space-y-4 overflow-y-auto">
                    {{-- Name --}}
                    <div>
                        <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                            {{ __('Full Name') }} <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" wire:model="name" class="w-full h-10 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-900 dark:text-white outline-none focus:border-[#003580]">
                        @error('name') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                            {{ __('Email Address') }} <span class="text-rose-500">*</span>
                        </label>
                        <input type="email" wire:model="email" class="w-full h-10 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-900 dark:text-white outline-none focus:border-[#003580]">
                        @error('email') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Role & Phone --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                                {{ __('Assigned Role') }} <span class="text-rose-500">*</span>
                            </label>
                            <select wire:model="role" class="w-full h-10 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-bold text-slate-900 dark:text-white outline-none focus:border-[#003580] cursor-pointer">
                                @foreach($roles as $r)
                                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                            @error('role') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                                {{ __('Phone Number') }}
                            </label>
                            <input type="text" wire:model="phone" placeholder="+20 100 000 0000" class="w-full h-10 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-900 dark:text-white outline-none focus:border-[#003580]">
                            @error('phone') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                            {{ __('Password') }} {!! !$isEditing ? '<span class="text-rose-500">*</span>' : '<span class="text-slate-400 font-normal">('.__('leave blank to keep current').')</span>' !!}
                        </label>
                        <input type="password" wire:model="password" placeholder="••••••••" class="w-full h-10 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-900 dark:text-white outline-none focus:border-[#003580]">
                        @error('password') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Bio --}}
                    <div>
                        <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                            {{ __('Bio / Notes') }}
                        </label>
                        <textarea wire:model="bio" rows="2" class="w-full p-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-900 dark:text-white outline-none focus:border-[#003580]"></textarea>
                    </div>

                    {{-- Is Active --}}
                    <div>
                        <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700 dark:text-slate-300">
                            <input type="checkbox" wire:model="is_active" class="w-4 h-4 rounded border-slate-300 text-[#003580] focus:ring-[#003580]">
                            <span>{{ __('Active Account') }}</span>
                        </label>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800 flex items-center justify-end gap-2">
                    <button type="button" wire:click="$set('showModal', false)" class="ta-btn ta-btn-md ta-btn-cancel">
                        {{ __('Cancel') }}
                    </button>
                    <button type="button" wire:click="saveUser" wire:loading.attr="disabled" class="ta-btn ta-btn-md ta-btn-primary">
                        <span wire:loading.remove>{{ $isEditing ? __('Update User') : __('Create User') }}</span>
                        <span wire:loading><i class="fas fa-spinner fa-spin"></i> {{ __('Saving...') }}</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Delete Modal --}}
    @if($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-xs">
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 w-full max-w-md p-6 text-center">
                <div class="w-12 h-12 rounded-full bg-rose-100 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 mx-auto flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <h3 class="text-base font-black text-slate-900 dark:text-white mb-2">
                    {{ __('Confirm Delete User') }}
                </h3>
                <p class="text-xs text-slate-500 mb-6">
                    {{ __('Are you sure you want to delete this user? This action cannot be undone.') }}
                </p>
                <div class="flex items-center justify-center gap-3">
                    <button type="button" wire:click="$set('showDeleteModal', false)" class="ta-btn ta-btn-md ta-btn-cancel">
                        {{ __('Cancel') }}
                    </button>
                    <button type="button" wire:click="deleteUser" class="ta-btn ta-btn-md ta-btn-delete">
                        {{ __('Yes, Delete') }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
