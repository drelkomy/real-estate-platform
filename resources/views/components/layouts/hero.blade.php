@php
    $heroLocale = app()->getLocale();
    $heroIsRtl = $heroLocale === 'ar';

    $categories = [
        'all' => ['label' => 'جميع العقارات', 'label_en' => 'All Properties', 'icon' => 'fa-city', 'color' => '#FEBB02'],
        'villas' => ['label' => 'فلل وقصور فاخرة', 'label_en' => 'Luxury Villas & Mansions', 'icon' => 'fa-landmark', 'color' => '#FB7185'],
        'apartments' => ['label' => 'شقق وبنتهاوس', 'label_en' => 'Apartments & Penthouses', 'icon' => 'fa-building', 'color' => '#34D399'],
        'duplex' => ['label' => 'دوبلكس وتاون هاوس', 'label_en' => 'Duplex & Townhouses', 'icon' => 'fa-layer-group', 'color' => '#A78BFA'],
        'chalets' => ['label' => 'شاليهات ومنتجعات', 'label_en' => 'Chalets & Resorts', 'icon' => 'fa-umbrella-beach', 'color' => '#FB923C'],
        'commercial' => ['label' => 'أبراج ومكاتب تجارية', 'label_en' => 'Commercial Towers', 'icon' => 'fa-briefcase', 'color' => '#22D3EE'],
        'lands' => ['label' => 'مخططات وأراضي استثمارية', 'label_en' => 'Investment Lands', 'icon' => 'fa-map-marked-alt', 'color' => '#FBBF24'],
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

{{-- ===== Booking.com Style Compact Royal Navy (#071529) & Imperial Gold (#D4AF37) Hero Section ===== --}}
<div class="relative w-full bg-[#071529] text-white pt-4 sm:pt-5 lg:pt-6 pb-0 shadow-md overflow-visible z-30 font-cairo"
     dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}">

    <div class="relative max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Category Pills Row with Colorful Icons & Smooth Horizontal Scroll --}}
        <div class="mb-2.5 sm:mb-3 lg:mb-3.5"
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
                 },
                 onClickCapture(e) {
                     if (this.hasDragged) {
                         e.preventDefault();
                         e.stopPropagation();
                     }
                 }
             }"
             @mouseup.window="onMouseUp()"
             @mouseleave="onMouseUp()">

            <div x-ref="catSlider"
                 @mousedown="onMouseDown($event)"
                 @mousemove="onMouseMove($event)"
                 @click.capture="onClickCapture($event)"
                 class="flex items-center gap-2 sm:gap-2.5 overflow-x-auto no-scrollbar py-2 justify-start flex-nowrap -mx-4 px-5 sm:mx-0 sm:px-2 select-none cursor-grab active:cursor-grabbing"
                 dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}">
                @foreach($categories as $catKey => $cat)
                    @php
                        $isActive = ($selectedCategory ?? 'all') === $catKey;
                    @endphp
                    <button type="button"
                            wire:click="setCategory('{{ $catKey }}')"
                            class="group shrink-0 px-3.5 sm:px-4 py-1.5 sm:py-2 rounded-full transition-all duration-200 flex items-center gap-2 text-[11.5px] sm:text-xs font-bold cursor-pointer whitespace-nowrap select-none border-0 shadow-none {{ $isActive ? 'bg-[#D4AF37] text-slate-950 font-black shadow-sm' : 'bg-white/10 hover:bg-white/20 text-white/95 hover:text-white' }}">
                        <i class="fas {{ $cat['icon'] }} text-[11px] sm:text-xs pointer-events-none" style="color: {{ $isActive ? '#071529' : $cat['color'] }};"></i>
                        <span class="pointer-events-none">{{ $heroIsRtl ? $cat['label'] : $cat['label_en'] }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Hero Headlines (Slightly Reduced Font Size & Snug Spacing) --}}
        <div class="mb-3 sm:mb-3.5 lg:mb-4 {{ $heroIsRtl ? 'text-right' : 'text-left' }}">
            <h1 class="text-base sm:text-lg md:text-xl lg:text-2xl font-black text-white tracking-tight leading-snug drop-shadow-sm font-cairo">
                {{ $heroIsRtl ? 'ابحث عن عقارك المثالي للبيع أو الإيجار في أرقى المواقع' : 'Find Your Ideal Property For Sale or Rent' }}
            </h1>
            <p class="text-[11.5px] sm:text-xs md:text-sm font-semibold text-white/85 mt-1 sm:mt-1.5 leading-relaxed">
                {{ $heroIsRtl ? 'عروض عقارية موثقة ومعتمدة برخصة فال من كبار المطورين والوسطاء العقاريين' : 'Curated luxury listings and verified FAL-certified properties across premier destinations' }}
            </p>
        </div>

        {{-- Floating Search Bar Capsule with Signature Imperial Gold Border (#D4AF37) --}}
        {{-- Overlapping the bottom edge of the Hero (Half in Hero, Half in Content Below) --}}
        <div class="relative z-30 translate-y-6 sm:translate-y-8 lg:translate-y-10 mb-2 sm:mb-4 lg:mb-0" dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}">
            <div class="bg-[#D4AF37] p-1 sm:p-1.5 rounded-2xl shadow-xl">
                <form wire:submit.prevent="applySearch" class="grid grid-cols-12 lg:flex lg:flex-row lg:items-stretch gap-1 sm:gap-1.5">

                    {{-- 1. City / Location Selector --}}
                    <div class="col-span-12 md:col-span-6 lg:flex-1 bg-white rounded-xl p-2.5 sm:p-3 lg:py-2 lg:px-3 flex items-center gap-2.5 relative hover:bg-slate-50 transition-colors select-none text-slate-900">
                        <div class="text-[#AA7C11] text-base sm:text-lg shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <label class="block text-[10px] sm:text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-0.5 truncate">
                                {{ $heroIsRtl ? 'المدينة / المنطقة' : 'Location' }}
                            </label>
                            <select wire:model.live="selectedCity" class="w-full bg-transparent text-xs sm:text-sm font-black text-slate-900 outline-none border-0 p-0 focus:ring-0 cursor-pointer">
                                <option value="" class="text-slate-900 font-bold">{{ $heroIsRtl ? 'جميع المدن' : 'All Cities' }}</option>
                                @foreach($citiesList as $c)
                                    <option value="{{ $c['id'] }}" class="text-slate-900 font-bold">{{ $heroIsRtl ? $c['name_ar'] : $c['name_en'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 2. Purpose Selector (Sale vs Rent) --}}
                    <div class="col-span-6 md:col-span-3 lg:w-44 bg-white rounded-xl p-2.5 sm:p-3 lg:py-2 lg:px-3 flex items-center gap-2.5 relative hover:bg-slate-50 transition-colors select-none text-slate-900">
                        <div class="text-[#AA7C11] text-base sm:text-lg shrink-0">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <label class="block text-[10px] sm:text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-0.5 truncate">
                                {{ $heroIsRtl ? 'الهدف' : 'Purpose' }}
                            </label>
                            <select wire:model.live="purpose" class="w-full bg-transparent text-xs sm:text-sm font-black text-slate-900 outline-none border-0 p-0 focus:ring-0 cursor-pointer">
                                <option value="all" class="text-slate-900 font-bold">{{ $heroIsRtl ? 'الكل (بيع وإيجار)' : 'All' }}</option>
                                <option value="sale" class="text-slate-900 font-bold">{{ $heroIsRtl ? 'للبيع' : 'For Sale' }}</option>
                                <option value="rent" class="text-slate-900 font-bold">{{ $heroIsRtl ? 'للإيجار' : 'For Rent' }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- 3. Property Type Selector --}}
                    <div class="col-span-6 md:col-span-3 lg:w-48 bg-white rounded-xl p-2.5 sm:p-3 lg:py-2 lg:px-3 flex items-center gap-2.5 relative hover:bg-slate-50 transition-colors select-none text-slate-900">
                        <div class="text-[#AA7C11] text-base sm:text-lg shrink-0">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <label class="block text-[10px] sm:text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-0.5 truncate">
                                {{ $heroIsRtl ? 'نوع العقار' : 'Property Type' }}
                            </label>
                            <select wire:model.live="selectedCategory" class="w-full bg-transparent text-xs sm:text-sm font-black text-slate-900 outline-none border-0 p-0 focus:ring-0 cursor-pointer">
                                @foreach($categories as $k => $c)
                                    <option value="{{ $k }}" class="text-slate-900 font-bold">{{ $heroIsRtl ? $c['label'] : $c['label_en'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 4. Keyword / District Input --}}
                    <div class="col-span-12 md:col-span-8 lg:flex-1 bg-white rounded-xl p-2.5 sm:p-3 lg:py-2 lg:px-3 flex items-center gap-2.5 relative hover:bg-slate-50 transition-colors select-none text-slate-900">
                        <div class="text-[#AA7C11] text-base sm:text-lg shrink-0">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <label class="block text-[10px] sm:text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-0.5 truncate">
                                {{ $heroIsRtl ? 'كلمة البحث' : 'Keyword' }}
                            </label>
                            <input type="text"
                                   wire:model.live.debounce.300ms="searchQuery"
                                   placeholder="{{ $heroIsRtl ? 'حي، مشروع، مسبح، كود...' : 'District, project, pool...' }}"
                                   class="w-full bg-transparent text-xs sm:text-sm font-bold text-slate-900 placeholder-slate-400 outline-none border-0 p-0 focus:ring-0">
                        </div>
                    </div>

                    {{-- 5. Search CTA Button in Deep Midnight Navy & Gold --}}
                    <div class="col-span-12 md:col-span-4 lg:w-36 flex items-stretch">
                        <button type="submit"
                                class="w-full min-h-[46px] rounded-xl bg-[#071529] hover:bg-[#0A1B33] text-[#D4AF37] hover:text-[#F3E5AB] text-xs sm:text-sm font-black shadow-md flex items-center justify-center gap-2 transition cursor-pointer border border-[#D4AF37]/30 hover:scale-[1.02] active:scale-[0.98]">
                            <i class="fas fa-search text-xs"></i>
                            <span>{{ $heroIsRtl ? 'بحث فوري' : 'Search' }}</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
