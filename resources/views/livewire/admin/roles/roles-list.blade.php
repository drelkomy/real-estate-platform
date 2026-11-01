<div>
    {{-- Breadcrumb --}}
    <x-admin.breadcrumb :items="[
        ['label' => __('Dashboard'), 'url' => route('admin.dashboard')],
        ['label' => __('Roles & Permissions'), 'url' => '']
    ]" />

    {{-- Top Action & Header --}}
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">{{ __('Roles & Permissions') }}</h1>
            <p class="text-xs text-slate-500 mt-1">{{ __('Define roles and granular access permissions for real estate platform users.') }}</p>
        </div>
        <button type="button" wire:click="openCreateModal" class="ta-btn ta-btn-md ta-btn-primary shadow-sm cursor-pointer self-start sm:self-auto">
            <i class="fas fa-plus"></i>
            <span>{{ __('Add New Role') }}</span>
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

    {{-- Roles Table --}}
    <div class="ta-table-wrap">
        <div class="ta-table-scroll">
            <table class="ta-table">
                <thead>
                    <tr>
                        <th class="text-start">{{ __('Role') }}</th>
                        <th class="text-center">{{ __('Users Count') }}</th>
                        <th class="text-center">{{ __('Permissions Count') }}</th>
                        <th class="text-center">{{ __('Guard') }}</th>
                        <th class="text-start">{{ __('Created') }}</th>
                        <th class="text-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center text-sm font-bold shrink-0">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-slate-900 dark:text-white capitalize">{{ $role->name }}</p>
                                        <p class="text-xs text-slate-500">{{ $role->name === 'super-admin' ? __('Full System Access') : __('Custom Platform Role') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="ta-badge ta-badge-light font-mono font-bold">
                                    {{ $role->users->count() }} {{ __('users') }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="ta-badge ta-badge-info font-mono font-bold">
                                    {{ $role->permissions->count() }} {{ __('permissions') }}
                                </span>
                            </td>
                            <td class="text-center text-xs font-mono text-slate-500">
                                {{ $role->guard_name }}
                            </td>
                            <td class="text-xs text-slate-500">
                                {{ $role->created_at?->format('Y-m-d') }}
                            </td>
                            <td class="text-center">
                                <div class="inline-flex items-center gap-1.5">
                                    <button type="button" 
                                            wire:click="openEditModal({{ $role->id }})" 
                                            class="ta-btn ta-btn-sm ta-btn-edit cursor-pointer" 
                                            title="{{ __('Edit Permissions') }}">
                                        <i class="fas fa-key"></i>
                                        <span>{{ __('Permissions') }}</span>
                                    </button>
                                    @if($role->name !== 'super-admin')
                                        <button type="button" 
                                                wire:click="confirmDelete({{ $role->id }})" 
                                                class="ta-btn ta-btn-sm ta-btn-delete cursor-pointer" 
                                                title="{{ __('Delete Role') }}">
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
                                {{ __('No roles defined yet.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $roles->links('livewire.admin.pagination') }}
        </div>
    </div>

    {{-- Create / Edit Role Modal --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-xs">
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
                
                {{-- Header --}}
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                    <h3 class="font-black text-base text-slate-900 dark:text-white">
                        {{ $isEditing ? __('Edit Role: :name', ['name' => $name]) : __('Add New Role') }}
                    </h3>
                    <button type="button" wire:click="$set('showModal', false)" class="text-slate-400 hover:text-slate-700 dark:hover:text-white cursor-pointer">
                        <i class="fas fa-times text-base"></i>
                    </button>
                </div>

                {{-- Body --}}
                <div class="p-6 space-y-5 overflow-y-auto">
                    {{-- Role Name --}}
                    <div>
                        <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                            {{ __('Role Name') }} <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               wire:model="name" 
                               placeholder="e.g. agency-broker"
                               class="w-full h-10 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-900 dark:text-white outline-none focus:border-[#003580]">
                        @error('name') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Permission Groups Matrix --}}
                    <div>
                        <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                            {{ __('Granular Permissions Matrix') }}
                        </label>
                        <div class="space-y-3">
                            @foreach($permissionGroups as $groupKey => $group)
                                <div class="p-3.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-800/40">
                                    <div class="flex items-center gap-2 mb-2 pb-1.5 border-b border-slate-200/80 dark:border-slate-800">
                                        <i class="{{ $group['icon'] }} text-[#00AEEF] text-xs"></i>
                                        <span class="text-xs font-bold text-slate-800 dark:text-slate-200">
                                            {{ app()->getLocale() === 'ar' ? $group['title_ar'] : $group['title_en'] }}
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach($group['permissions'] as $perm)
                                            <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-700 dark:text-slate-300 p-1 rounded hover:bg-white dark:hover:bg-slate-800">
                                                <input type="checkbox" 
                                                       wire:model="selectedPermissions" 
                                                       value="{{ $perm }}"
                                                       class="w-4 h-4 rounded border-slate-300 text-[#003580] focus:ring-[#003580]">
                                                <span class="font-mono text-[11px]">{{ $perm }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800 flex items-center justify-end gap-2">
                    <button type="button" wire:click="$set('showModal', false)" class="ta-btn ta-btn-md ta-btn-cancel">
                        {{ __('Cancel') }}
                    </button>
                    <button type="button" wire:click="saveRole" wire:loading.attr="disabled" class="ta-btn ta-btn-md ta-btn-primary">
                        <span wire:loading.remove>{{ $isEditing ? __('Update Role') : __('Create Role') }}</span>
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
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="text-base font-black text-slate-900 dark:text-white mb-2">
                    {{ __('Confirm Delete Role') }}
                </h3>
                <p class="text-xs text-slate-500 mb-6">
                    {{ __('Are you sure you want to delete this role? Any users assigned to this role will lose its permissions.') }}
                </p>
                <div class="flex items-center justify-center gap-3">
                    <button type="button" wire:click="$set('showDeleteModal', false)" class="ta-btn ta-btn-md ta-btn-cancel">
                        {{ __('Cancel') }}
                    </button>
                    <button type="button" wire:click="deleteRole" class="ta-btn ta-btn-md ta-btn-delete">
                        {{ __('Yes, Delete Role') }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
