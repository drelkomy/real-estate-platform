<div x-data="{ showPassword: false }">

    {{-- Brand Header on Form --}}
    <div class="mb-8">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-blue-50 dark:bg-white/5 border border-blue-200/60 dark:border-white/10 text-xs font-black text-[#003580] dark:text-[#38BDF8] mb-4 shadow-2xs">
            <i class="fas fa-key text-[11px]"></i>
            <span>{{ __('Portal Access') }}</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
            {{ __('Sign In to Your Account') }}
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-2 font-medium">
            {{ __('Welcome back! Please enter your details to proceed.') }}
        </p>
    </div>

    {{-- Error Alert --}}
    @if($errorMessage)
        <div class="mb-6 p-4 rounded-2xl bg-rose-50 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/20 text-rose-700 dark:text-rose-400 text-xs sm:text-sm font-bold flex items-center gap-3">
            <i class="fas fa-exclamation-circle text-base shrink-0"></i>
            <span>{{ $errorMessage }}</span>
        </div>
    @endif

    {{-- Form --}}
    <form wire:submit="login" class="space-y-4 sm:space-y-5">
        
        {{-- Email Field --}}
        <div>
            <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                {{ __('Email Address') }}
            </label>
            <div class="relative">
                <input type="email" 
                       wire:model="email" 
                       required 
                       autofocus
                       placeholder="name@example.com"
                       class="w-full h-12 px-4 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-medium focus:border-[#003580] focus:ring-3 focus:ring-blue-500/15 outline-none transition">
                <span class="absolute inset-y-0 end-4 flex items-center text-slate-400 pointer-events-none">
                    <i class="fas fa-envelope text-xs"></i>
                </span>
            </div>
            @error('email') <span class="text-rose-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- Password Field --}}
        <div>
            <div class="flex items-center justify-between mb-2">
                <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                    {{ __('Password') }}
                </label>
            </div>
            <div class="relative">
                <input :type="showPassword ? 'text' : 'password'" 
                       wire:model="password" 
                       required 
                       placeholder="••••••••"
                       class="w-full h-12 px-4 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-medium focus:border-[#003580] focus:ring-3 focus:ring-blue-500/15 outline-none transition">
                <button type="button" 
                        @click="showPassword = !showPassword"
                        class="absolute inset-y-0 end-4 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 cursor-pointer">
                    <i class="fas" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            @error('password') <span class="text-rose-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- Remember Me & Forgot Password --}}
        <div class="flex items-center justify-between text-xs font-bold pt-1">
            <label class="flex items-center gap-2 text-slate-600 dark:text-slate-400 cursor-pointer">
                <input type="checkbox" wire:model="remember" class="w-4 h-4 rounded border-slate-300 text-[#003580] focus:ring-[#003580]">
                <span>{{ __('Remember Me') }}</span>
            </label>
        </div>

        {{-- Submit Button --}}
        <div class="pt-2">
            <button type="submit" 
                    wire:loading.attr="disabled"
                    class="w-full h-12 rounded-xl bg-[#003580] hover:bg-[#002860] active:scale-[0.99] text-white text-sm font-black shadow-lg shadow-blue-900/25 hover:shadow-blue-900/40 transition-all flex items-center justify-center gap-2 cursor-pointer">
                <span wire:loading.remove>{{ __('Sign In') }}</span>
                <span wire:loading><i class="fas fa-spinner fa-spin"></i> {{ __('Processing...') }}</span>
            </button>
        </div>

        {{-- Demo Credentials Hint Box --}}
        <div class="p-3.5 rounded-xl bg-slate-100 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 text-[11px] text-slate-600 dark:text-slate-400 space-y-1">
            <p class="font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5">
                <i class="fas fa-info-circle text-[#00AEEF]"></i>
                <span>{{ __('Demo Accounts (Password: password):') }}</span>
            </p>
            <div class="flex items-center justify-between font-mono text-[10px] pt-1">
                <span>Super Admin:</span>
                <span class="text-blue-600 dark:text-blue-400 font-bold">admin@realestate.local</span>
            </div>
            <div class="flex items-center justify-between font-mono text-[10px]">
                <span>Agent:</span>
                <span class="text-blue-600 dark:text-blue-400 font-bold">agent@realestate.local</span>
            </div>
        </div>

        {{-- Register Link --}}
        <div class="text-center pt-3 text-xs text-slate-500 dark:text-slate-400 font-bold">
            <span>{{ __("Don't have an account?") }}</span>
            <a href="{{ route('register') }}" class="text-[#003580] dark:text-[#38BDF8] hover:underline font-black ms-1">
                {{ __('Create an account') }}
            </a>
        </div>

    </form>

</div>

