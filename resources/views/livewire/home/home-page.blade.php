@php
    $isRtl = app()->getLocale() === 'ar';
@endphp

<div>
    {{-- 1. Signature Hero Section with Draggable Categories and Floating Search Capsule --}}
    @include('components.layouts.hero')

    {{-- 2. Platform Value Props / Trust Indicators in Deep Navy & Gold --}}
    <section class="relative max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 pt-10 sm:pt-12 lg:pt-16 pb-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/90 hover:border-[#D4AF37]/50 shadow-xs hover:shadow-md transition-all flex items-center gap-3.5 group">
                <div class="w-12 h-12 rounded-xl bg-[#071529] text-[#D4AF37] flex items-center justify-center text-xl shrink-0 group-hover:scale-105 transition-transform shadow-sm">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div>
                    <h4 class="font-black text-xs sm:text-sm text-slate-900">{{ $isRtl ? 'عقارات مرخصة وموثقة' : 'Verified Listings' }}</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">{{ $isRtl ? 'وفق أنظمة الهيئة العامة للعقار' : 'Compliant with regulations' }}</p>
                </div>
            </div>

            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/90 hover:border-emerald-500/50 shadow-xs hover:shadow-md transition-all flex items-center gap-3.5 group">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0 group-hover:scale-105 transition-transform shadow-sm">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <div>
                    <h4 class="font-black text-xs sm:text-sm text-slate-900">{{ $isRtl ? 'تواصل مباشر مع المعلن' : 'Direct Contact' }}</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">{{ $isRtl ? 'واتساب واتصال فوري دون وسيط' : 'Instant WhatsApp or call' }}</p>
                </div>
            </div>

            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/90 hover:border-[#D4AF37]/50 shadow-xs hover:shadow-md transition-all flex items-center gap-3.5 group">
                <div class="w-12 h-12 rounded-xl bg-[#071529] text-[#D4AF37] flex items-center justify-center text-xl shrink-0 group-hover:scale-105 transition-transform shadow-sm">
                    <i class="fas fa-certificate"></i>
                </div>
                <div>
                    <h4 class="font-black text-xs sm:text-sm text-slate-900">{{ $isRtl ? 'وسطاء برخصة فال' : 'Licensed Brokers' }}</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">{{ $isRtl ? 'وكلاء ومكاتب عقارية معتمدة' : 'Authorized agents & agencies' }}</p>
                </div>
            </div>

            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/90 hover:border-[#D4AF37]/50 shadow-xs hover:shadow-md transition-all flex items-center gap-3.5 group">
                <div class="w-12 h-12 rounded-xl bg-[#071529] text-[#D4AF37] flex items-center justify-center text-xl shrink-0 group-hover:scale-105 transition-transform shadow-sm">
                    <i class="fas fa-gem"></i>
                </div>
                <div>
                    <h4 class="font-black text-xs sm:text-sm text-slate-900">{{ $isRtl ? 'صفقات VIP حصرية' : 'Exclusive VIP Deals' }}</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">{{ $isRtl ? 'فرص استثمارية مباشرة وأسعار مضمونة' : 'Direct deals & prime ROI' }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Top Cities / Destinations Section --}}
    <section id="destinations" class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
            <div>
                <span class="text-xs sm:text-sm font-black text-[#D4AF37] uppercase tracking-wider block mb-1 flex items-center gap-1.5">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $isRtl ? 'المدن الأكثر طلباً واستثماراً' : 'Top Real Estate Destinations' }}</span>
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-tight">
                    {{ $isRtl ? 'استكشف أفخم العقارات حسب المدينة' : 'Explore Properties by City' }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 font-medium">
                    {{ $isRtl ? 'تصفح العروض المميزة في أبرز العواصم والمناطق السكنية والاستثمارية' : 'Browse handpicked properties in premier metropolitan areas' }}
                </p>
            </div>
            @if(!empty($selectedCity))
                <button type="button"
                        wire:click="$set('selectedCity', '')"
                        class="ta-btn ta-btn-sm ta-btn-outline cursor-pointer self-start sm:self-auto">
                    <i class="fas fa-th-large text-[#D4AF37]"></i>
                    <span>{{ $isRtl ? 'عرض جميع المدن' : 'Show All Cities' }}</span>
                </button>
            @endif
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
            @php
                $destinations = [
                    ['id' => 'riyadh', 'name_ar' => 'الرياض', 'name_en' => 'Riyadh', 'count' => 1420, 'img' => 'https://images.unsplash.com/photo-1586724237569-f3d0c1dee8c6?auto=format&fit=crop&w=600&q=80'],
                    ['id' => 'dubai', 'name_ar' => 'دبي', 'name_en' => 'Dubai', 'count' => 2180, 'img' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=600&q=80'],
                    ['id' => 'jeddah', 'name_ar' => 'جدة', 'name_en' => 'Jeddah', 'count' => 840, 'img' => 'https://images.unsplash.com/photo-1580674684081-7617fbf3d745?auto=format&fit=crop&w=600&q=80'],
                    ['id' => 'cairo', 'name_ar' => 'القاهرة الجديدة', 'name_en' => 'New Cairo', 'count' => 1950, 'img' => 'https://images.unsplash.com/photo-1572252009286-268acec5ca0a?auto=format&fit=crop&w=600&q=80'],
                    ['id' => 'zayed', 'name_ar' => 'الشيخ زايد', 'name_en' => 'Sheikh Zayed', 'count' => 760, 'img' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=600&q=80'],
                    ['id' => 'khobar', 'name_ar' => 'الخبر', 'name_en' => 'Al Khobar', 'count' => 520, 'img' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=600&q=80'],
                ];
            @endphp

            @foreach($destinations as $dest)
                @php
                    $isCityActive = ($selectedCity === $dest['id']);
                @endphp
                <div wire:click="$set('selectedCity', '{{ $isCityActive ? '' : $dest['id'] }}')"
                     class="group relative h-40 sm:h-48 rounded-2xl overflow-hidden cursor-pointer shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 {{ $isCityActive ? 'ring-4 ring-[#D4AF37] scale-[1.03]' : 'border border-slate-200/80 hover:border-[#D4AF37]/50' }}">
                    <img src="{{ $dest['img'] }}" alt="{{ $dest['name_ar'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/30 to-transparent"></div>

                    @if($isCityActive)
                        <div class="absolute top-2.5 {{ $isRtl ? 'right-2.5' : 'left-2.5' }} bg-gradient-to-r from-[#E5C158] to-[#D4AF37] text-slate-950 text-[10px] font-black px-2.5 py-0.5 rounded-full flex items-center gap-1 shadow-md">
                            <i class="fas fa-check text-[9px]"></i>
                            <span>{{ $isRtl ? 'محدد' : 'Active' }}</span>
                        </div>
                    @endif

                    <div class="absolute bottom-2.5 inset-x-2.5 text-white">
                        <h3 class="font-black text-xs sm:text-sm text-white group-hover:text-[#F3E5AB] transition-colors leading-tight">
                            {{ $isRtl ? $dest['name_ar'] : $dest['name_en'] }}
                        </h3>
                        <p class="text-[10px] text-slate-300 font-semibold mt-0.5 flex items-center gap-1">
                            <i class="fas fa-building text-[#D4AF37] text-[9px]"></i>
                            <span>{{ number_format($dest['count']) }} {{ $isRtl ? 'عقار' : 'units' }}</span>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 4. Featured Properties Grid Section --}}
    <section id="featured-properties" class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-6 border-b border-slate-200">
            <div>
                <span class="text-xs sm:text-sm font-black text-[#D4AF37] uppercase tracking-wider block mb-1 flex items-center gap-1.5">
                    <i class="fas fa-crown text-xs"></i>
                    <span>{{ $isRtl ? 'قائمة العقارات المعتمدة والمرخصة' : 'Verified & Licensed Listings' }}</span>
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-tight">
                    {{ $isRtl ? 'أحدث العروض العقارية المتاحة' : 'Latest Available Properties' }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 font-medium">
                    {{ $isRtl ? "عرض {$totalCount} عقار يطابق معايير البحث الحالية" : "Showing {$totalCount} properties matching current criteria" }}
                </p>
            </div>

            {{-- Quick Purpose Filter Switch in Deep Navy & Gold --}}
            <div class="flex items-center gap-2 self-start md:self-auto p-1 rounded-2xl bg-slate-100 border border-slate-200">
                <button type="button"
                        wire:click="setPurpose('all')"
                        class="px-4 py-2 rounded-xl text-xs font-black transition cursor-pointer {{ $purpose === 'all' ? 'bg-[#071529] text-[#D4AF37] shadow-sm border border-[#D4AF37]/30' : 'text-slate-700 hover:text-slate-950' }}">
                    {{ $isRtl ? 'الكل' : 'All' }}
                </button>
                <button type="button"
                        wire:click="setPurpose('sale')"
                        class="px-4 py-2 rounded-xl text-xs font-black transition cursor-pointer {{ $purpose === 'sale' ? 'bg-[#071529] text-[#D4AF37] shadow-sm border border-[#D4AF37]/30' : 'text-slate-700 hover:text-slate-950' }}">
                    {{ $isRtl ? 'للبيع' : 'For Sale' }}
                </button>
                <button type="button"
                        wire:click="setPurpose('rent')"
                        class="px-4 py-2 rounded-xl text-xs font-black transition cursor-pointer {{ $purpose === 'rent' ? 'bg-[#071529] text-[#D4AF37] shadow-sm border border-[#D4AF37]/30' : 'text-slate-700 hover:text-slate-950' }}">
                    {{ $isRtl ? 'للإيجار' : 'For Rent' }}
                </button>
            </div>
        </div>

        {{-- Properties Grid --}}
        @if($properties->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6 pt-8">
                @foreach($properties as $property)
                    <x-property-card :property="$property" />
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-3xl border border-slate-200/80 my-8">
                <div class="w-16 h-16 rounded-full bg-slate-100 text-[#D4AF37] mx-auto flex items-center justify-center text-2xl mb-3">
                    <i class="fas fa-home"></i>
                </div>
                <h3 class="font-black text-lg text-slate-800">{{ $isRtl ? 'لا توجد عقارات تطابق البحث حالياً' : 'No properties found matching criteria' }}</h3>
                <p class="text-xs text-slate-500 mt-1">{{ $isRtl ? 'جرّب تغيير خيارات التصفية أو اختيار مدينة أخرى' : 'Try resetting or broadening your search filters.' }}</p>
                <button type="button"
                        wire:click="$set('selectedCategory', 'all'); $set('selectedCity', ''); $set('purpose', 'all'); $set('searchQuery', '');"
                        class="mt-4 px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#E5C158] via-[#D4AF37] to-[#AA7C11] text-slate-950 text-xs font-black shadow-md cursor-pointer">
                    <i class="fas fa-redo text-xs me-1"></i>
                    <span>{{ $isRtl ? 'إعادة ضبط كل الفلاتر' : 'Reset All Filters' }}</span>
                </button>
            </div>
        @endif
    </section>

    {{-- 5. Call To Action: List Your Property in Midnight Navy & Gold --}}
    <section class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-r from-[#071529] via-[#0A1B33] to-[#040D1A] text-white shadow-2xl flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden border-2 border-[#D4AF37]/30">
            <div class="relative z-10 max-w-xl">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-[#D4AF37]/15 text-[#F3E5AB] text-xs font-black mb-3 border border-[#D4AF37]/30">
                    <i class="fas fa-bullhorn text-[#D4AF37]"></i>
                    {{ $isRtl ? 'انضم إلى نخبة المعلنين والمطورين' : 'For Owners & Real Estate Developers' }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-black tracking-tight leading-tight">
                    {{ $isRtl ? 'هل ترغب في بيع أو تأجير عقارك بأعلى عائد؟' : 'Looking to Sell or Lease Your Property Faster?' }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 mt-2 leading-relaxed">
                    {{ $isRtl ? 'سجل معنا كمعلن معتمد وانشر إعلاناتك أمام آلاف المشترين الجادين يومياً مع دعم تسويقي متكامل وضمان رخصة فال.' : 'Join as a verified agent and showcase your listings to thousands of serious buyers daily.' }}
                </p>
            </div>
            <div class="relative z-10 flex flex-wrap gap-3">
                <a href="{{ route('register') }}" class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-[#E5C158] via-[#D4AF37] to-[#AA7C11] hover:from-[#F3E5AB] hover:to-[#D4AF37] text-slate-950 text-sm font-black shadow-lg shadow-amber-500/25 transition">
                    <i class="fas fa-plus-circle me-1.5"></i>
                    <span>{{ $isRtl ? 'أضف عقارك الآن مجاناً' : 'Add Your Property' }}</span>
                </a>
                <a href="{{ route('login') }}" class="px-6 py-3.5 rounded-2xl bg-white/5 hover:bg-white/10 text-white text-sm font-bold transition border border-[#D4AF37]/40">
                    <span>{{ $isRtl ? 'دخول لوحة التحكم' : 'Agent Portal' }}</span>
                </a>
            </div>
        </div>
    </section>

</div>
