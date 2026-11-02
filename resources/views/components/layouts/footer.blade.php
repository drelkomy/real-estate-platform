@php
    $footerLocale = app()->getLocale();
    $footerIsRtl = $footerLocale === 'ar';
@endphp

{{-- ===== Reusable Global Footer Component (Inspired by 9Ducks Multi-Column Architecture) ===== --}}
<footer class="bg-[#040D1A] text-white pt-14 pb-8 border-t-2 border-[#D4AF37]/30 font-cairo"
        dir="{{ $footerIsRtl ? 'rtl' : 'ltr' }}">
    <div class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">

        {{-- 4 Columns Grid System --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-10 mb-12">

            {{-- Column 1: Brand Info & Social Network (Span 4) --}}
            <div class="lg:col-span-4 space-y-4">
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

                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-sm">
                    {{ __('Your premier gateway for verified residential and commercial luxury properties, executive penthouses, mansions, and strategic land developments.') }}
                </p>

                {{-- Official License Badge --}}
                <div class="p-3 rounded-xl bg-[#071529] border border-[#D4AF37]/30 flex items-center gap-2.5 max-w-sm">
                    <div class="w-9 h-9 rounded-lg bg-[#D4AF37]/15 text-[#D4AF37] flex items-center justify-center text-base shrink-0">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div>
                        <p class="text-xs font-black text-white">{{ __('REGA & FAL Certified') }}</p>
                        <p class="text-[10.5px] text-[#D4AF37] font-bold">{{ __('Authorized Brokerage License #12000045') }}</p>
                    </div>
                </div>

                {{-- Social & Communication Links --}}
                <div class="flex items-center gap-2 pt-1 flex-wrap">
                    <a href="https://wa.me/966500000000" target="_blank" rel="noopener noreferrer"
                       class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 hover:border-emerald-500 hover:bg-emerald-600 hover:text-white text-slate-300 flex items-center justify-center text-sm transition-all duration-200"
                       title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="tel:+966110000000"
                       class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 hover:border-[#D4AF37] hover:bg-[#D4AF37] hover:text-slate-950 text-slate-300 flex items-center justify-center text-sm transition-all duration-200"
                       title="Call Us">
                        <i class="fas fa-phone-alt"></i>
                    </a>
                    <a href="#"
                       class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 hover:border-[#D4AF37] hover:bg-[#D4AF37] hover:text-slate-950 text-slate-300 flex items-center justify-center text-sm transition-all duration-200"
                       title="X / Twitter">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                    <a href="#"
                       class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 hover:border-[#D4AF37] hover:bg-[#D4AF37] hover:text-slate-950 text-slate-300 flex items-center justify-center text-sm transition-all duration-200"
                       title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#"
                       class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 hover:border-[#D4AF37] hover:bg-[#D4AF37] hover:text-slate-950 text-slate-300 flex items-center justify-center text-sm transition-all duration-200"
                       title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            {{-- Column 2: Explore Platform (Span 3) --}}
            <div class="lg:col-span-3">
                <h4 class="font-black text-sm text-[#F3E5AB] uppercase tracking-wider mb-4 border-b border-[#D4AF37]/30 pb-2.5 flex items-center gap-2">
                    <i class="fas fa-compass text-[#D4AF37] text-xs"></i>
                    <span>{{ $footerIsRtl ? 'استكشف المنصة' : 'Explore Platform' }}</span>
                </h4>
                <ul class="space-y-2.5 text-xs sm:text-sm text-slate-300">
                    <li>
                        <a href="#featured-properties" class="hover:text-[#D4AF37] transition flex items-center gap-1.5">
                            <i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i>
                            <span>{{ __('Luxury Villas & Mansions') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#featured-properties" class="hover:text-[#D4AF37] transition flex items-center gap-1.5">
                            <i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i>
                            <span>{{ __('Modern Apartments & Penthouses') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#featured-properties" class="hover:text-[#D4AF37] transition flex items-center gap-1.5">
                            <i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i>
                            <span>{{ __('Coastal Chalets & Resorts') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#categories" class="hover:text-[#D4AF37] transition flex items-center gap-1.5">
                            <i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i>
                            <span>{{ __('Commercial Towers & Offices') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#destinations" class="hover:text-[#D4AF37] transition flex items-center gap-1.5">
                            <i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i>
                            <span>{{ __('Top Cities') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="text-[#D4AF37] font-bold hover:underline transition flex items-center gap-1.5">
                            <i class="fas fa-handshake text-xs"></i>
                            <span>{{ $footerIsRtl ? 'انضم كوسيط أو شريك معتمد' : 'Join as Certified Broker' }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Column 3: Governance & Legal (Span 2) --}}
            <div class="lg:col-span-2">
                <h4 class="font-black text-sm text-[#F3E5AB] uppercase tracking-wider mb-4 border-b border-[#D4AF37]/30 pb-2.5 flex items-center gap-2">
                    <i class="fas fa-balance-scale text-[#D4AF37] text-xs"></i>
                    <span>{{ $footerIsRtl ? 'الحوكمة والسياسات' : 'Terms & Policies' }}</span>
                </h4>
                <ul class="space-y-2.5 text-xs sm:text-sm text-slate-300">
                    <li>
                        <a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5">
                            <i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i>
                            <span>{{ $footerIsRtl ? 'الشروط والأحكام' : 'Terms of Service' }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5">
                            <i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i>
                            <span>{{ $footerIsRtl ? 'سياسة الخصوصية' : 'Privacy Policy' }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5">
                            <i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i>
                            <span>{{ $footerIsRtl ? 'معايير الإعلانات العقارية' : 'Listing Standards' }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5">
                            <i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i>
                            <span>{{ $footerIsRtl ? 'رخصة فال والهيئة العامة' : 'FAL Regulations' }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-[#D4AF37] transition flex items-center gap-1.5">
                            <i class="fas fa-chevron-left text-[9px] text-[#D4AF37]"></i>
                            <span>{{ $footerIsRtl ? 'الأسئلة الشائعة' : 'FAQ' }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Column 4: Trust & Safety (Span 3 - Inspired by 9Ducks) --}}
            <div class="lg:col-span-3">
                <h4 class="font-black text-sm text-[#F3E5AB] uppercase tracking-wider mb-4 border-b border-[#D4AF37]/30 pb-2.5 flex items-center gap-2">
                    <i class="fas fa-shield-alt text-[#D4AF37] text-xs"></i>
                    <span>{{ $footerIsRtl ? 'الموثوقية والأمان' : 'Trust & Safety' }}</span>
                </h4>
                <ul class="space-y-3 text-xs sm:text-sm text-slate-300">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-certificate text-[#D4AF37] text-sm mt-0.5 shrink-0"></i>
                        <div>
                            <span class="block font-bold text-white">{{ $footerIsRtl ? 'عقارات معتمدة برخصة فال' : 'FAL Certified Properties' }}</span>
                            <span class="block text-[11px] text-slate-400">{{ $footerIsRtl ? 'مطابقة لأنظمة الهيئة العامة للعقار' : 'REGA Compliant Brokerage' }}</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-file-signature text-emerald-400 text-sm mt-0.5 shrink-0"></i>
                        <div>
                            <span class="block font-bold text-white">{{ $footerIsRtl ? 'عقود إلكترونية رسمية' : 'Legally Binding Contracts' }}</span>
                            <span class="block text-[11px] text-slate-400">{{ $footerIsRtl ? 'عبر منصة إيجار والأنظمة الرسمية' : 'Official Government Portals' }}</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-lock text-[#D4AF37] text-sm mt-0.5 shrink-0"></i>
                        <div>
                            <span class="block font-bold text-white">{{ $footerIsRtl ? 'حماية وخصوصية تامة' : 'Bank-Grade Security' }}</span>
                            <span class="block text-[11px] text-slate-400">{{ $footerIsRtl ? 'تشفير بيانات وفق المعايير البنكية' : 'SSL Encrypted Operations' }}</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-headset text-sky-400 text-sm mt-0.5 shrink-0"></i>
                        <div>
                            <span class="block font-bold text-white">{{ $footerIsRtl ? 'مستشار عقاري متخصص 24/7' : '24/7 Dedicated Support' }}</span>
                            <span class="block text-[11px] text-slate-400">{{ $footerIsRtl ? 'استشارات ومرافقة لإتمام الصفقات' : 'VIP Transaction Advisors' }}</span>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

        {{-- Bottom Copyright & Payment/Trust Bar (True Centered Copyright) --}}
        <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-slate-400">

            {{-- Side Badges --}}
            <div class="flex items-center gap-2 text-slate-400 order-2 md:order-1">
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-white/5 border border-white/10 text-[11px] font-bold text-slate-300">
                    <i class="fas fa-shield-alt text-[#D4AF37]"></i>
                    <span>فال #12000045</span>
                </span>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-white/5 border border-white/10 text-[11px] font-bold text-slate-300">
                    <span>الهيئة العامة للعقار</span>
                </span>
            </div>

            {{-- Centered Copyright Text --}}
            <div class="text-center order-1 md:order-2 font-bold">
                &copy; {{ date('Y') }} &mdash; {{ __('All rights reserved to') }}
                <strong class="text-white">{{ config('app.name', 'Real Estate Platform') }}</strong>
            </div>

            {{-- Payment & Trust Icons --}}
            <div class="flex items-center gap-3 text-lg text-slate-400 order-3">
                <i class="fab fa-cc-visa hover:text-white transition" title="Visa"></i>
                <i class="fab fa-cc-mastercard hover:text-white transition" title="Mastercard"></i>
                <i class="fab fa-cc-apple-pay hover:text-white transition" title="Apple Pay"></i>
                <span class="text-xs font-bold text-slate-300 px-1.5 py-0.5 rounded bg-white/10 border border-white/15">مدى mada</span>
            </div>

        </div>

    </div>
</footer>

