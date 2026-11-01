<div x-data="{ showPassword: false }">

    {{-- Header --}}
    <div class="mb-6">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-emerald-50 dark:bg-white/5 border border-emerald-200/60 dark:border-white/10 text-xs font-black text-emerald-700 dark:text-emerald-400 mb-3 shadow-2xs">
            <i class="fas fa-user-plus text-[11px]"></i>
            <span>{{ __('Join Platform') }}</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
            {{ __('Create a New Account') }}
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1.5 font-medium">
            {{ __('Get started with thousands of verified real estate listings and buyers.') }}
        </p>
    </div>

    {{-- Form --}}
    <form wire:submit="register" class="space-y-4">
        
        {{-- Account Type Toggle (Client vs Agent) --}}
        <div>
            <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                {{ __('Account Type') }}
            </label>
            <div class="grid grid-cols-2 gap-3">
                <button type="button" 
                        wire:click="$set('account_type', 'client')"
                        class="p-3 rounded-xl border text-xs font-black flex items-center justify-center gap-2 transition cursor-pointer {{ $account_type === 'client' ? 'border-[#003580] bg-blue-50/60 dark:bg-blue-500/10 text-[#003580] dark:text-[#38BDF8] ring-2 ring-blue-500/20' : 'border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }}">
                    <i class="fas fa-user"></i>
                    <span>{{ __('Buyer / Tenant') }}</span>
                </button>
                <button type="button" 
                        wire:click="$set('account_type', 'agent')"
                        class="p-3 rounded-xl border text-xs font-black flex items-center justify-center gap-2 transition cursor-pointer {{ $account_type === 'agent' ? 'border-[#003580] bg-blue-50/60 dark:bg-blue-500/10 text-[#003580] dark:text-[#38BDF8] ring-2 ring-blue-500/20' : 'border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }}">
                    <i class="fas fa-building"></i>
                    <span>{{ __('Real Estate Agent') }}</span>
                </button>
            </div>
        </div>

        {{-- Full Name --}}
        <div>
            <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                {{ __('Full Name') }}
            </label>
            <input type="text" 
                   wire:model="name" 
                   required 
                   placeholder="{{ __('e.g. Ahmed Moustafa') }}"
                   class="w-full h-11 px-4 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-medium focus:border-[#003580] focus:ring-3 focus:ring-blue-500/15 outline-none transition">
            @error('name') <span class="text-rose-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- Email & Phone --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                    {{ __('Email Address') }}
                </label>
                <input type="email" 
                       wire:model="email" 
                       required 
                       placeholder="name@example.com"
                       class="w-full h-11 px-4 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-medium focus:border-[#003580] focus:ring-3 focus:ring-blue-500/15 outline-none transition">
                @error('email') <span class="text-rose-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                    {{ __('Phone Number') }}
                </label>
                <input type="text" 
                       wire:model="phone" 
                       placeholder="+20 100 000 0000"
                       class="w-full h-11 px-4 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-medium focus:border-[#003580] focus:ring-3 focus:ring-blue-500/15 outline-none transition">
                @error('phone') <span class="text-rose-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Password & Confirmation --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                    {{ __('Password') }}
                </label>
                <input :type="showPassword ? 'text' : 'password'" 
                       wire:model="password" 
                       required 
                       placeholder="••••••••"
                       class="w-full h-11 px-4 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-medium focus:border-[#003580] focus:ring-3 focus:ring-blue-500/15 outline-none transition">
                @error('password') <span class="text-rose-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                    {{ __('Confirm Password') }}
                </label>
                <input :type="showPassword ? 'text' : 'password'" 
                       wire:model="password_confirmation" 
                       required 
                       placeholder="••••••••"
                       class="w-full h-11 px-4 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-medium focus:border-[#003580] focus:ring-3 focus:ring-blue-500/15 outline-none transition">
            </div>
        </div>

        {{-- Terms Checkbox --}}
        <div class="pt-1">
            <label class="flex items-start gap-2.5 text-xs text-slate-600 dark:text-slate-400 cursor-pointer">
                <input type="checkbox" wire:model="terms" required class="mt-0.5 w-4 h-4 rounded border-slate-300 text-[#003580] focus:ring-[#003580]">
                <span>
                    {{ __('I agree to the') }} 
                    <a href="#" class="text-[#003580] dark:text-[#38BDF8] underline font-bold">{{ __('Terms of Service') }}</a> 
                    {{ __('and') }} 
                    <a href="#" class="text-[#003580] dark:text-[#38BDF8] underline font-bold">{{ __('Privacy Policy') }}</a>.
                </span>
            </label>
            @error('terms') <span class="text-rose-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- Submit Button --}}
        <div class="pt-2">
            <button type="submit" 
                    wire:loading.attr="disabled"
                    class="w-full h-12 rounded-xl bg-[#003580] hover:bg-[#002860] active:scale-[0.99] text-white text-sm font-black shadow-lg shadow-blue-900/25 hover:shadow-blue-900/40 transition-all flex items-center justify-center gap-2 cursor-pointer">
                <span wire:loading.remove>{{ __('Create Account') }}</span>
                <span wire:loading><i class="fas fa-spinner fa-spin"></i> {{ __('Creating account...') }}</span>
            </button>
        </div>

        {{-- Sign In Link --}}
        <div class="text-center pt-2 text-xs text-slate-500 dark:text-slate-400 font-bold">
            <span>{{ __('Already have an account?') }}</span>
            <a href="{{ route('login') }}" class="text-[#003580] dark:text-[#38BDF8] hover:underline font-black ms-1">
                {{ __('Sign In') }}
            </a>
        </div>

    </form>

</div>
