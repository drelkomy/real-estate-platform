@php
    $heroLocale = app()->getLocale();
    $heroIsRtl = $heroLocale === 'ar';

    $categories = [
        'all' => ['label' => 'جميع العقارات', 'label_en' => 'All Properties', 'icon' => 'fa-city', 'color' => '#D4AF37'],
        'villas' => ['label' => 'فلل وقصور فاخرة', 'label_en' => 'Luxury Villas & Mansions', 'icon' => 'fa-landmark', 'color' => '#E5C158'],
        'apartments' => ['label' => 'شقق وبنتهاوس', 'label_en' => 'Apartments & Penthouses', 'icon' => 'fa-building', 'color' => '#F3E5AB'],
        'duplex' => ['label' => 'دوبلكس وتاون هاوس', 'label_en' => 'Duplex & Townhouses', 'icon' => 'fa-layer-group', 'color' => '#D4AF37'],
        'chalets' => ['label' => 'شاليهات ومنتجعات', 'label_en' => 'Chalets & Resorts', 'icon' => 'fa-umbrella-beach', 'color' => '#E5C158'],
        'commercial' => ['label' => 'أبراج ومكاتب تجارية', 'label_en' => 'Commercial Towers', 'icon' => 'fa-briefcase', 'color' => '#F3E5AB'],
        'lands' => ['label' => 'مخططات وأراضي استثمارية', 'label_en' => 'Investment Lands', 'icon' => 'fa-map-marked-alt', 'color' => '#D4AF37'],
    ];

    $citiesList = [
        ['id' => 'riyadh', 'name_ar' => 'الرياض', 'name_en' => 'Riyadh'],
        ['id' => 'dubai', 'name_ar' => 'دبي', 'name_en' => 'Dubai'],
        ['id' => 'jeddah', 'name_ar' => 'جدة', 'name_en' => 'Jeddah'],
        ['id' => 'cairo', 'name_ar' => 'القاهرة الجديدة', 'name_en' => 'New Cairo'],
        ['id' => 'zayed', 'name_ar' => 'الشيخ زايد', 'name_en' => 'Sheikh Zayed'],
        ['id' => 'khobar', 'name_ar' => 'الخبر', 'name_en' => 'Al Khobar'],
    ];
@endphp

{{-- ===== Signature Luxury Deep Navy & Royal Gold Hero Section ===== --}}
<div class="relative w-full bg-gradient-to-b from-[#071529] via-[#0A1B33] to-[#040D1A] text-white pt-10 sm:pt-14 lg:pt-18 pb-24 sm:pb-28 lg:pb-32 shadow-2xl overflow-visible z-30 font-cairo"
     dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}">

    {{-- Subtle Royal Architectural Glows --}}
    <div class="pointer-events-none absolute inset-0 overflow-hidden opacity-30">
        <div class="absolute -top-32 -left-32 w-[32rem] h-[32rem] rounded-full bg-[#D4AF37]/15 blur-[120px]"></div>
        <div class="absolute top-1/3 -right-32 w-[36rem] h-[36rem] rounded-full bg-[#0F356B]/35 blur-[140px]"></div>
    </div>

    <div class="relative max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Category Pills Row with Draggable Slider & Gold Highlights --}}
        <div class="mb-5 sm:mb-7"
             x-data="{
                 isDown: false,
                 startX: 0,
                 scrollStart: 0,
                 hasDragged: false,
                 onMouseDown(e) {
                     this.isDown = true;
                     this.hasDragged = false;
                     this.startX = e.pageX - this.$refs.catSlider.offsetLeft;
                     this.scrollStart = this.$refs.catSlider.scrollLeft;
                 },
                 onMouseMove(e) {
                     if (!this.isDown) return;
                     const x = e.pageX - this.$refs.catSlider.offsetLeft;
                     const walk = x - this.startX;
                     if (Math.abs(walk) > 4) {
                         this.hasDragged = true;
                         e.preventDefault();
                     }
                     this.$refs.catSlider.scrollLeft = this.scrollStart - walk;
                 },
                 onMouseUp() {
                     if (this.isDown) {
                         this.isDown = false;
                         setTimeout(() => { this.hasDragged = false; }, 60);
                     }
                 }
             }"
             @mouseup.window="onMouseUp()"
             @mouseleave="onMouseUp()">

            <div x-ref="catSlider"
                 @mousedown="onMouseDown($event)"
                 @mousemove="onMouseMove($event)"
                 class="flex items-center gap-2 sm:gap-3 overflow-x-auto no-scrollbar py-2 justify-start flex-nowrap -mx-4 px-5 sm:mx-0 sm:px-2 select-none cursor-grab active:cursor-grabbing"
                 dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}">
                @foreach($categories as $catKey => $cat)
                    @php
                        $isActive = ($selectedCategory ?? 'all') === $catKey;
                    @endphp
                    <button type="button"
                            wire:click="setCategory('{{ $catKey }}')"
                            class="group shrink-0 px-4 sm:px-5 py-2.5 rounded-full transition-all duration-300 flex items-center gap-2.5 text-xs sm:text-sm font-black cursor-pointer whitespace-nowrap select-none {{ $isActive ? 'bg-gradient-to-r from-[#E5C158] via-[#D4AF37] to-[#AA7C11] text-slate-950 shadow-lg shadow-amber-500/25 ring-2 ring-[#D4AF37]/50 scale-[1.03]' : 'bg-[#0B1E38]/80 hover:bg-[#0F284A] text-slate-200 hover:text-white border border-[#D4AF37]/25 hover:border-[#D4AF37]/60 backdrop-blur-md' }}">
                        <i class="fas {{ $cat['icon'] }} text-xs pointer-events-none {{ $isActive ? 'text-slate-950' : 'text-[#D4AF37]' }}"></i>
                        <span class="pointer-events-none">{{ $heroIsRtl ? $cat['label'] : $cat['label_en'] }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Hero Headlines --}}
        <div class="mb-6 sm:mb-8 text-center max-w-4xl mx-auto">
            {{-- Trust & Authority Badge --}}
            <div class="inline-flex items-center gap-2.5 px-4 sm:px-5 py-1.5 rounded-full bg-[#D4AF37]/10 backdrop-blur-md border border-[#D4AF37]/40 text-xs sm:text-sm font-black text-[#F3E5AB] mb-4 shadow-sm">
                <i class="fas fa-crown text-[#D4AF37] text-xs"></i>
                <span>{{ $heroIsRtl ? 'المنصة العقارية الأكثر موثوقية وفخامة • مرخصة رسمياً برخصة فال' : 'Premier Certified Luxury Real Estate Platform' }}</span>
            </div>

            {{-- Headline --}}
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight drop-shadow-sm font-cairo">
                @if($heroIsRtl)
                    اكتشف أفخم العقارات الاستثنائية <br class="hidden sm:inline" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FDF7E7] via-[#D4AF37] to-[#AA7C11]">للبيع والإيجار الراقي</span>
                @else
                    Discover Exceptional Luxury Properties <br class="hidden sm:inline" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FDF7E7] via-[#D4AF37] to-[#AA7C11]">For Prime Sale & Lease</span>
                @endif
            </h1>

            {{-- Subtitle --}}
            <p class="text-xs sm:text-sm md:text-base font-semibold text-slate-300 mt-3 sm:mt-4 max-w-2xl mx-auto leading-relaxed">
                {{ $heroIsRtl ? 'آلاف العروض العقارية الموثقة والقصور والفلل الفاخرة مباشرة من كبار المطورين والوسطاء المعتمدين مع شفافية تامة.' : 'Curated luxury villas, prime estates and penthouses directly from verified developers and FAL-certified brokers.' }}
            </p>
        </div>

        {{-- Floating Search Bar Capsule with Royal Gold Border & Navy Surface --}}
        <div class="relative z-30 translate-y-10 sm:translate-y-12 lg:translate-y-14" dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}">
            {{-- Outer Gold Gradient Frame --}}
            <div class="p-1.5 sm:p-2 rounded-3xl bg-gradient-to-r from-[#AA7C11] via-[#D4AF37] to-[#F3E5AB] shadow-[0_20px_60px_-15px_rgba(212,175,55,0.25)]">

                {{-- Inner Deep Navy Container --}}
                <div class="bg-[#071529] p-2.5 sm:p-3.5 rounded-2xl sm:rounded-[22px]">
                    <form wire:submit.prevent="applySearch" class="grid grid-cols-1 md:grid-cols-12 gap-2 sm:gap-2.5">

                        {{-- 1. City / Location Selector --}}
                        <div class="md:col-span-3 bg-[#0B1E38] hover:bg-[#0F284A] border border-[#D4AF37]/25 focus-within:border-[#D4AF37] rounded-xl sm:rounded-2xl p-2.5 sm:p-3 flex items-center gap-2.5 transition group">
                            <div class="text-[#D4AF37] text-lg shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <label class="block text-[10px] font-black text-[#D4AF37] uppercase tracking-wider">
                                    {{ $heroIsRtl ? 'المدينة / المنطقة' : 'Location' }}
                                </label>
                                <select wire:model.live="selectedCity" class="w-full bg-transparent text-xs sm:text-sm font-black text-white outline-none border-0 p-0 focus:ring-0 cursor-pointer">
                                    <option value="" class="bg-[#071529] text-white">{{ $heroIsRtl ? 'جميع المدن' : 'All Cities' }}</option>
                                    @foreach($citiesList as $c)
                                        <option value="{{ $c['id'] }}" class="bg-[#071529] text-white font-bold">{{ $heroIsRtl ? $c['name_ar'] : $c['name_en'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- 2. Purpose Selector (Sale vs Rent) --}}
                        <div class="md:col-span-2 bg-[#0B1E38] hover:bg-[#0F284A] border border-[#D4AF37]/25 focus-within:border-[#D4AF37] rounded-xl sm:rounded-2xl p-2.5 sm:p-3 flex items-center gap-2.5 transition group">
                            <div class="text-[#D4AF37] text-lg shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fas fa-tags"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <label class="block text-[10px] font-black text-[#D4AF37] uppercase tracking-wider">
                                    {{ $heroIsRtl ? 'الهدف' : 'Purpose' }}
                                </label>
                                <select wire:model.live="purpose" class="w-full bg-transparent text-xs sm:text-sm font-black text-white outline-none border-0 p-0 focus:ring-0 cursor-pointer">
                                    <option value="all" class="bg-[#071529] text-white">{{ $heroIsRtl ? 'الكل (بيع وإيجار)' : 'All (Sale & Rent)' }}</option>
                                    <option value="sale" class="bg-[#071529] text-white">{{ $heroIsRtl ? 'للبيع' : 'For Sale' }}</option>
                                    <option value="rent" class="bg-[#071529] text-white">{{ $heroIsRtl ? 'للإيجار' : 'For Rent' }}</option>
                                </select>
                            </div>
                        </div>

                        {{-- 3. Property Type --}}
                        <div class="md:col-span-2 bg-[#0B1E38] hover:bg-[#0F284A] border border-[#D4AF37]/25 focus-within:border-[#D4AF37] rounded-xl sm:rounded-2xl p-2.5 sm:p-3 flex items-center gap-2.5 transition group">
                            <div class="text-[#D4AF37] text-lg shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <label class="block text-[10px] font-black text-[#D4AF37] uppercase tracking-wider">
                                    {{ $heroIsRtl ? 'نوع العقار' : 'Property Type' }}
                                </label>
                                <select wire:model.live="selectedCategory" class="w-full bg-transparent text-xs sm:text-sm font-black text-white outline-none border-0 p-0 focus:ring-0 cursor-pointer">
                                    @foreach($categories as $k => $c)
                                        <option value="{{ $k }}" class="bg-[#071529] text-white">{{ $heroIsRtl ? $c['label'] : $c['label_en'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- 4. Keyword / District Input --}}
                        <div class="md:col-span-3 bg-[#0B1E38] hover:bg-[#0F284A] border border-[#D4AF37]/25 focus-within:border-[#D4AF37] rounded-xl sm:rounded-2xl p-2.5 sm:p-3 flex items-center gap-2.5 transition group">
                            <div class="text-[#D4AF37] text-lg shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <label class="block text-[10px] font-black text-[#D4AF37] uppercase tracking-wider">
                                    {{ $heroIsRtl ? 'كلمة البحث' : 'Keyword' }}
                                </label>
                                <input type="text"
                                       wire:model.live.debounce.300ms="searchQuery"
                                       placeholder="{{ $heroIsRtl ? 'حي، مشروع، مسبح، كود...' : 'District, project, pool...' }}"
                                       class="w-full bg-transparent text-xs sm:text-sm font-bold text-white placeholder-slate-400 outline-none border-0 p-0 focus:ring-0">
                            </div>
                        </div>

                        {{-- 5. Search CTA Button in Royal Gold --}}
                        <div class="md:col-span-2 flex items-center">
                            <button type="submit"
                                    class="w-full h-full min-h-[52px] rounded-xl sm:rounded-2xl bg-gradient-to-r from-[#E5C158] via-[#D4AF37] to-[#AA7C11] hover:from-[#F3E5AB] hover:to-[#D4AF37] text-slate-950 text-xs sm:text-sm font-black shadow-lg shadow-amber-500/30 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer">
                                <i class="fas fa-search text-sm"></i>
                                <span>{{ $heroIsRtl ? 'بحث فوري' : 'Search' }}</span>
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
