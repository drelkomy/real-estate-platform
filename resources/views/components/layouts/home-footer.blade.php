<footer class="bg-[#001e47] text-white pt-12 pb-8 border-t border-white/10 font-cairo">
    <div class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
            
            {{-- Brand info --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#00AEEF] to-[#003580] flex items-center justify-center text-xl shadow-md">
                        🏢
                    </div>
                    <div>
                        <span class="block font-black text-lg text-white leading-tight">
                            {{ config('app.name', 'Real Estate Platform') }}
                        </span>
                        <span class="block text-[10px] text-cyan-300 font-bold uppercase tracking-wider">
                            {{ __('Licensed Real Estate Hub') }}
                        </span>
                    </div>
                </div>
                <p class="text-xs text-slate-300 leading-relaxed">
                    {{ __('Your trusted gateway for premier residential and commercial properties, luxury villas, chalets, and smart investments.') }}
                </p>
                <div class="flex items-center gap-2 text-sm text-cyan-300">
                    <i class="fas fa-certificate text-amber-400"></i>
                    <span class="text-xs font-bold">{{ __('Certified Real Estate Platform') }}</span>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-black text-sm text-white uppercase tracking-wider mb-4 border-b border-white/10 pb-2">
                    {{ __('Property Types') }}
                </h4>
                <ul class="space-y-2 text-xs text-slate-300">
                    <li><a href="#" class="hover:text-cyan-300 transition">{{ __('Luxury Villas & Mansions') }}</a></li>
                    <li><a href="#" class="hover:text-cyan-300 transition">{{ __('Modern Apartments & Penthouses') }}</a></li>
                    <li><a href="#" class="hover:text-cyan-300 transition">{{ __('Coastal Chalets & Resorts') }}</a></li>
                    <li><a href="#" class="hover:text-cyan-300 transition">{{ __('Commercial Offices & Retail') }}</a></li>
                    <li><a href="#" class="hover:text-cyan-300 transition">{{ __('Plots & Development Lands') }}</a></li>
                </ul>
            </div>

            {{-- Top Locations --}}
            <div>
                <h4 class="font-black text-sm text-white uppercase tracking-wider mb-4 border-b border-white/10 pb-2">
                    {{ __('Top Cities') }}
                </h4>
                <ul class="space-y-2 text-xs text-slate-300">
                    <li><a href="#" class="hover:text-cyan-300 transition">{{ __('Riyadh - New Districts') }}</a></li>
                    <li><a href="#" class="hover:text-cyan-300 transition">{{ __('Dubai - Marina & Downtown') }}</a></li>
                    <li><a href="#" class="hover:text-cyan-300 transition">{{ __('Jeddah - Corniche') }}</a></li>
                    <li><a href="#" class="hover:text-cyan-300 transition">{{ __('Cairo - New Cairo & Zayed') }}</a></li>
                    <li><a href="#" class="hover:text-cyan-300 transition">{{ __('North Coast & Red Sea') }}</a></li>
                </ul>
            </div>

            {{-- Direct Contact & Support --}}
            <div>
                <h4 class="font-black text-sm text-white uppercase tracking-wider mb-4 border-b border-white/10 pb-2">
                    {{ __('Contact & Inquiries') }}
                </h4>
                <div class="space-y-3 text-xs text-slate-300">
                    <p class="flex items-center gap-2">
                        <i class="fas fa-envelope text-[#00AEEF]"></i>
                        <span>support@realestate.local</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fab fa-whatsapp text-emerald-400 text-sm"></i>
                        <span>+966 50 000 0000 / +20 100 000 0000</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fas fa-clock text-amber-400"></i>
                        <span>{{ __('24/7 Dedicated Client Support') }}</span>
                    </p>
                </div>
            </div>

        </div>

        {{-- Bottom Copyright --}}
        <div class="pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-3">
            <p>
                &copy; {{ date('Y') }} {{ config('app.name', 'Real Estate Platform') }}. {{ __('All rights reserved.') }}
            </p>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-white transition">{{ __('Privacy Policy') }}</a>
                <span>•</span>
                <a href="#" class="hover:text-white transition">{{ __('Terms of Service') }}</a>
                <span>•</span>
                <a href="{{ route('login') }}" class="hover:text-white transition">{{ __('Agent Portal') }}</a>
            </div>
        </div>
    </div>
</footer>
