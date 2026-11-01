<footer class="bg-[#040D1A] text-white pt-14 pb-8 border-t-2 border-[#D4AF37]/30 font-cairo">
    <div class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">

        {{-- VIP Newsletter & Exclusive Alerts Row --}}
        <div class="mb-12 p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-[#071529] via-[#0A1B33] to-[#0D2342] border border-[#D4AF37]/30 shadow-xl flex flex-col lg:flex-row items-center justify-between gap-6">
            <div class="max-w-xl text-center lg:text-start">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#D4AF37]/10 text-[#F3E5AB] text-xs font-bold mb-2 border border-[#D4AF37]/20">
                    <i class="fas fa-gem text-[#D4AF37]"></i>
                    {{ __('VIP Property Alerts') }}
                </span>
                <h3 class="text-lg sm:text-xl font-black text-white">
                    {{ __('Be First to Receive Prime Off-Market Deals') }}
                </h3>
                <p class="text-xs text-slate-300 mt-1">
                    {{ __('Subscribe to our exclusive newsletter for verified investment opportunities and premier luxury villas.') }}
                </p>
            </div>
            <div class="w-full lg:w-auto flex-1 max-w-md">
                <form class="flex items-center gap-2">
                    <input type="email"
                           placeholder="{{ __('Enter your VIP email address...') }}"
                           class="flex-1 h-12 px-4 rounded-xl bg-[#040D1A] border border-[#D4AF37]/30 text-white placeholder-slate-400 text-xs font-bold focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37] outline-none transition">
                    <button type="button"
                            class="h-12 px-5 rounded-xl bg-gradient-to-r from-[#E5C158] via-[#D4AF37] to-[#AA7C11] hover:from-[#F3E5AB] hover:to-[#D4AF37] text-slate-950 text-xs font-black shadow-md shadow-amber-500/20 whitespace-nowrap cursor-pointer transition">
                        {{ __('Join VIP') }}
                    </button>
                </form>
            </div>
        </div>

        {{-- 4 Columns Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">

            {{-- Column 1: Brand Info & License --}}
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-[#AA7C11] via-[#D4AF37] to-[#F3E5AB] text-slate-950 flex items-center justify-center text-xl shadow-md shadow-amber-500/20">
                        🏢
                    </div>
                    <div>
                        <span class="block font-black text-lg text-white leading-tight">
                            {{ config('app.name', 'Real Estate Platform') }}
                        </span>
                        <span class="block text-[10px] text-[#D4AF37] font-black uppercase tracking-wider flex items-center gap-1">
                            <i class="fas fa-crown text-[8px]"></i>
                            <span>{{ __('Luxury Real Estate Hub') }}</span>
                        </span>
                    </div>
                </div>
                <p class="text-xs text-slate-300 leading-relaxed">
                    {{ __('Your premier gateway for verified residential and commercial luxury properties, executive penthouses, mansions, and strategic land developments.') }}
                </p>

                {{-- Certified License Card --}}
                <div class="p-3 rounded-xl bg-[#071529] border border-[#D4AF37]/30 flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-lg bg-[#D4AF37]/15 text-[#D4AF37] flex items-center justify-center text-base shrink-0">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div>
                        <p class="text-xs font-black text-white">{{ __('REGA & FAL Certified') }}</p>
                        <p class="text-[10px] text-[#D4AF37] font-bold">{{ __('Authorized Brokerage License #12000045') }}</p>
                    </div>
                </div>
            </div>

            {{-- Column 2: Property Categories --}}
            <div>
                <h4 class="font-black text-sm text-[#F3E5AB] uppercase tracking-wider mb-4 border-b border-[#D4AF37]/30 pb-2.5 flex items-center gap-2">
                    <i class="fas fa-city text-[#D4AF37] text-xs"></i>
                    <span>{{ __('Property Types') }}</span>
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-300">
                    <li><a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5"><i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i> {{ __('Luxury Villas & Mansions') }}</a></li>
                    <li><a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5"><i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i> {{ __('Modern Apartments & Penthouses') }}</a></li>
                    <li><a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5"><i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i> {{ __('Coastal Chalets & Resorts') }}</a></li>
                    <li><a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5"><i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i> {{ __('Commercial Towers & Offices') }}</a></li>
                    <li><a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5"><i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i> {{ __('Investment Plots & Lands') }}</a></li>
                </ul>
            </div>

            {{-- Column 3: Top Cities --}}
            <div>
                <h4 class="font-black text-sm text-[#F3E5AB] uppercase tracking-wider mb-4 border-b border-[#D4AF37]/30 pb-2.5 flex items-center gap-2">
                    <i class="fas fa-map-marker-alt text-[#D4AF37] text-xs"></i>
                    <span>{{ __('Top Cities') }}</span>
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-300">
                    <li><a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5"><i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i> {{ __('Riyadh - New Districts') }}</a></li>
                    <li><a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5"><i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i> {{ __('Dubai - Marina & Downtown') }}</a></li>
                    <li><a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5"><i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i> {{ __('Jeddah - Corniche') }}</a></li>
                    <li><a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5"><i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i> {{ __('Cairo - New Cairo & Zayed') }}</a></li>
                    <li><a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5"><i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i> {{ __('North Coast & Red Sea') }}</a></li>
                </ul>
            </div>

            {{-- Column 4: Contact & Inquiries --}}
            <div>
                <h4 class="font-black text-sm text-[#F3E5AB] uppercase tracking-wider mb-4 border-b border-[#D4AF37]/30 pb-2.5 flex items-center gap-2">
                    <i class="fas fa-headset text-[#D4AF37] text-xs"></i>
                    <span>{{ __('Contact & Inquiries') }}</span>
                </h4>
                <div class="space-y-3.5 text-xs text-slate-300">
                    <p class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg bg-[#071529] border border-[#D4AF37]/30 text-[#D4AF37] flex items-center justify-center shrink-0">
                            <i class="fas fa-envelope text-xs"></i>
                        </span>
                        <span>vip@realestate.local</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg bg-[#071529] border border-emerald-500/30 text-emerald-400 flex items-center justify-center shrink-0">
                            <i class="fab fa-whatsapp text-sm"></i>
                        </span>
                        <span>+966 50 000 0000 / +20 100 000 0000</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg bg-[#071529] border border-[#D4AF37]/30 text-[#D4AF37] flex items-center justify-center shrink-0">
                            <i class="fas fa-clock text-xs"></i>
                        </span>
                        <span>{{ __('24/7 Dedicated Concierge Support') }}</span>
                    </p>
                </div>
            </div>

        </div>

        {{-- Bottom Copyright & Badges --}}
        <div class="pt-6 border-t border-[#D4AF37]/20 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-3">
            <p>
                &copy; {{ date('Y') }} <span class="text-[#D4AF37] font-bold">{{ config('app.name', 'Real Estate Platform') }}</span>. {{ __('All rights reserved.') }}
            </p>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-[#D4AF37] transition">{{ __('Privacy Policy') }}</a>
                <span>•</span>
                <a href="#" class="hover:text-[#D4AF37] transition">{{ __('Terms of Service') }}</a>
                <span>•</span>
                <a href="{{ route('login') }}" class="hover:text-[#D4AF37] font-bold transition">{{ __('Agent & Broker Portal') }}</a>
            </div>
        </div>

    </div>
</footer>
