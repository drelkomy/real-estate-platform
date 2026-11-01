<div>
    {{-- Breadcrumb --}}
    <x-admin.breadcrumb :items="[
        ['label' => __('Dashboard'), 'url' => route('admin.dashboard')],
        ['label' => __('My Profile'), 'url' => '']
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">{{ __('Account Settings') }}</h1>
        <p class="text-xs text-slate-500 mt-1">{{ __('Manage your personal identity, contact details, and account security.') }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Profile Summary Sidebar --}}
        <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs text-center flex flex-col items-center">
            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover border-4 border-white dark:border-slate-800 shadow-md mb-4">
            <h3 class="font-black text-lg text-slate-900 dark:text-white">{{ $user->name }}</h3>
            <p class="text-xs text-slate-500 mb-3">{{ $user->email }}</p>
            
            <div class="flex flex-wrap justify-center gap-1.5 mb-4">
                @foreach($user->roles as $role)
                    <span class="ta-badge ta-badge-info">{{ $role->name }}</span>
                @endforeach
            </div>

            <div class="w-full pt-4 border-t border-slate-100 dark:border-slate-800 text-xs text-slate-500 space-y-2 text-start">
                <div class="flex items-center justify-between">
                    <span class="font-bold">{{ __('Status') }}:</span>
                    <span class="ta-badge ta-badge-success">{{ __('Active') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="font-bold">{{ __('Member Since') }}:</span>
                    <span>{{ $user->created_at?->format('F Y') }}</span>
                </div>
            </div>
        </div>

        {{-- Forms Column --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Profile Details Card --}}
            <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs">
                <h2 class="font-black text-base text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-user-edit text-[#00AEEF]"></i>
                    <span>{{ __('Personal Information') }}</span>
                </h2>

                @if(session()->has('profile_success'))
                    <div class="mb-4 p-3.5 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-xs font-bold flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('profile_success') }}</span>
                    </div>
                @endif

                <form wire:submit="updateProfile" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                                {{ __('Full Name') }} <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" wire:model="name" class="w-full h-11 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-900 dark:text-white outline-none focus:border-[#003580]">
                            @error('name') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                                {{ __('Email Address') }} <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" wire:model="email" class="w-full h-11 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-900 dark:text-white outline-none focus:border-[#003580]">
                            @error('email') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            {{ __('Phone Number') }}
                        </label>
                        <input type="text" wire:model="phone" class="w-full h-11 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-900 dark:text-white outline-none focus:border-[#003580]">
                        @error('phone') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            {{ __('Bio / Summary') }}
                        </label>
                        <textarea wire:model="bio" rows="3" class="w-full p-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-900 dark:text-white outline-none focus:border-[#003580]"></textarea>
                        @error('bio') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" wire:loading.attr="disabled" class="ta-btn ta-btn-md ta-btn-primary">
                            <span wire:loading.remove>{{ __('Save Changes') }}</span>
                            <span wire:loading><i class="fas fa-spinner fa-spin"></i> {{ __('Saving...') }}</span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Change Password Card --}}
            <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs">
                <h2 class="font-black text-base text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-lock text-[#00AEEF]"></i>
                    <span>{{ __('Security & Password') }}</span>
                </h2>

                @if(session()->has('password_success'))
                    <div class="mb-4 p-3.5 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-xs font-bold flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('password_success') }}</span>
                    </div>
                @endif

                <form wire:submit="updatePassword" class="space-y-4">
                    <div>
                        <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            {{ __('Current Password') }} <span class="text-rose-500">*</span>
                        </label>
                        <input type="password" wire:model="current_password" class="w-full h-11 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-900 dark:text-white outline-none focus:border-[#003580]">
                        @error('current_password') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                                {{ __('New Password') }} <span class="text-rose-500">*</span>
                            </label>
                            <input type="password" wire:model="new_password" class="w-full h-11 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-900 dark:text-white outline-none focus:border-[#003580]">
                            @error('new_password') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                                {{ __('Confirm New Password') }} <span class="text-rose-500">*</span>
                            </label>
                            <input type="password" wire:model="new_password_confirmation" class="w-full h-11 px-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-900 dark:text-white outline-none focus:border-[#003580]">
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" wire:loading.attr="disabled" class="ta-btn ta-btn-md ta-btn-primary">
                            <span wire:loading.remove>{{ __('Update Password') }}</span>
                            <span wire:loading><i class="fas fa-spinner fa-spin"></i> {{ __('Updating...') }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
