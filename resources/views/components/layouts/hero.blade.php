@php
    $heroLocale = app()->getLocale();
    $heroIsRtl = $heroLocale === 'ar';

    $categories = [
        'all' => ['label' => 'جميع العقارات', 'label_en' => 'All Properties', 'icon' => 'fa-city', 'color' => '#00AEEF'],
        'apartments' => ['label' => 'شقق سكنية', 'label_en' => 'Apartments', 'icon' => 'fa-building', 'color' => '#34D399'],
        'villas' => ['label' => 'فلل وقصور', 'label_en' => 'Villas & Mansions', 'icon' => 'fa-home', 'color' => '#FB7185'],
        'duplex' => ['label' => 'دوبلكس وبنتهاوس', 'label_en' => 'Duplex & Penthouse', 'icon' => 'fa-layer-group', 'color' => '#A78BFA'],
        'chalets' => ['label' => 'شاليهات ومنتجعات', 'label_en' => 'Chalets & Resorts', 'icon' => 'fa-umbrella-beach', 'color' => '#FB923C'],
        'commercial' => ['label' => 'مكاتب ومحلات تجارية', 'label_en' => 'Commercial', 'icon' => 'fa-briefcase', 'color' => '#FBBF24'],
        'lands' => ['label' => 'أراضي ومخططات', 'label_en' => 'Lands & Plots', 'icon' => 'fa-map', 'color' => '#22D3EE'],
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

{{-- ===== Signature Royal Blue Hero Section with Overlapping Filter (from tit4booking) ===== --}}
<div class="relative w-full bg-gradient-to-b from-[#003580] via-[#002b66] to-[#001e47] text-white pt-8 sm:pt-10 lg:pt-14 pb-20 sm:pb-24 lg:pb-28 shadow-xl overflow-visible z-30 font-cairo"
     dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}">

    {{-- Subtle Background Glows --}}
    <div class="pointer-events-none absolute inset-0 overflow-hidden opacity-25">
        <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-cyan-400 blur-3xl"></div>
        <div class="absolute top-1/2 -right-32 w-96 h-96 rounded-full bg-blue-500 blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Category Pills Row with Draggable Slider & Colorful Icons --}}
        <div class="mb-4 sm:mb-6"
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
                 class="flex items-center gap-2 sm:gap-2.5 overflow-x-auto no-scrollbar py-2 justify-start flex-nowrap -mx-4 px-5 sm:mx-0 sm:px-2 select-none cursor-grab active:cursor-grabbing" 
                 dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}">
                @foreach($categories as $catKey => $cat)
                    @php
                        $isActive = ($selectedCategory ?? 'all') === $catKey;
                    @endphp
                    <button type="button"
                            wire:click="setCategory('{{ $catKey }}')" 
                            class="group shrink-0 px-4 sm:px-4.5 py-2 rounded-full transition-all duration-200 flex items-center gap-2 text-xs sm:text-sm font-bold cursor-pointer whitespace-nowrap select-none border-0 shadow-none {{ $isActive ? 'bg-[#00AEEF] text-white shadow-md' : 'bg-white/10 hover:bg-white/20 text-white/95 hover:text-white' }}">
                        <i class="fas {{ $cat['icon'] }} text-xs pointer-events-none" style="color: {{ $isActive ? '#ffffff' : $cat['color'] }};"></i>
                        <span class="pointer-events-none">{{ $heroIsRtl ? $cat['label'] : $cat['label_en'] }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Hero Headlines --}}
        <div class="mb-4 sm:mb-6 text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-bold text-cyan-200 mb-3 shadow-sm">
                <i class="fas fa-shield-alt text-[#FEBB02]"></i>
                <span>{{ $heroIsRtl ? 'منصة عقارية مرخصة ومعتمدة بأحدث التقنيات' : 'Certified & Licensed Real Estate Platform' }}</span>
            </div>
            
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight drop-shadow-sm font-cairo">
                @if($heroIsRtl)
                    اكتشف أفضل العقارات <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 via-sky-200 to-white">للبيع والإيجار</span>
                @else
                    Discover Premier Properties <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 via-sky-200 to-white">For Sale & Rent</span>
                @endif
            </h1>
            <p class="text-xs sm:text-sm md:text-base font-medium text-white/90 mt-2 sm:mt-3 leading-relaxed">
                {{ $heroIsRtl ? 'آلاف العروض العقارية الموثقة مباشرة من الملاك وأفضل الوكلاء المعتمدين.' : 'Thousands of verified property listings directly from owners and certified brokers.' }}
            </p>
        </div>

        {{-- Floating Search Bar Capsule with Signature Yellow Border (#FEBB02) --}}
        <div class="relative z-30 translate-y-8 sm:translate-y-10 lg:translate-y-12" dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}">
            <div class="bg-[#FEBB02] p-1.5 sm:p-2 rounded-2xl sm:rounded-3xl shadow-2xl">
                <form wire:submit.prevent="applySearch" class="grid grid-cols-1 md:grid-cols-12 gap-1.5 sm:gap-2">
                    
                    {{-- 1. City / Location Selector --}}
                    <div class="md:col-span-3 bg-white rounded-xl sm:rounded-2xl p-2.5 sm:p-3 flex items-center gap-2.5 hover:bg-slate-50 transition">
                        <div class="text-[#00AEEF] text-lg shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-wider">
                                {{ $heroIsRtl ? 'المدينة / المنطقة' : 'Location' }}
                            </label>
                            <select wire:model.live="selectedCity" class="w-full bg-transparent text-xs sm:text-sm font-black text-slate-900 outline-none border-0 p-0 focus:ring-0 cursor-pointer">
                                <option value="">{{ $heroIsRtl ? 'جميع المدن' : 'All Cities' }}</option>
                                @foreach($citiesList as $c)
                                    <option value="{{ $c['id'] }}">{{ $heroIsRtl ? $c['name_ar'] : $c['name_en'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 2. Purpose Selector (Sale vs Rent) --}}
                    <div class="md:col-span-2 bg-white rounded-xl sm:rounded-2xl p-2.5 sm:p-3 flex items-center gap-2.5 hover:bg-slate-50 transition">
                        <div class="text-amber-500 text-lg shrink-0">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-wider">
                                {{ $heroIsRtl ? 'الهدف' : 'Purpose' }}
                            </label>
                            <select wire:model.live="purpose" class="w-full bg-transparent text-xs sm:text-sm font-black text-slate-900 outline-none border-0 p-0 focus:ring-0 cursor-pointer">
                                <option value="all">{{ $heroIsRtl ? 'الكل (بيع وإيجار)' : 'All (Sale & Rent)' }}</option>
                                <option value="sale">{{ $heroIsRtl ? 'للبيع' : 'For Sale' }}</option>
                                <option value="rent">{{ $heroIsRtl ? 'للإيجار' : 'For Rent' }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- 3. Property Type --}}
                    <div class="md:col-span-2 bg-white rounded-xl sm:rounded-2xl p-2.5 sm:p-3 flex items-center gap-2.5 hover:bg-slate-50 transition">
                        <div class="text-emerald-500 text-lg shrink-0">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-wider">
                                {{ $heroIsRtl ? 'نوع العقار' : 'Property Type' }}
                            </label>
                            <select wire:model.live="selectedCategory" class="w-full bg-transparent text-xs sm:text-sm font-black text-slate-900 outline-none border-0 p-0 focus:ring-0 cursor-pointer">
                                @foreach($categories as $k => $c)
                                    <option value="{{ $k }}">{{ $heroIsRtl ? $c['label'] : $c['label_en'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 4. Keyword / Search Query --}}
                    <div class="md:col-span-3 bg-white rounded-xl sm:rounded-2xl p-2.5 sm:p-3 flex items-center gap-2.5 hover:bg-slate-50 transition">
                        <div class="text-purple-500 text-lg shrink-0">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-wider">
                                {{ $heroIsRtl ? 'كلمة البحث' : 'Keyword' }}
                            </label>
                            <input type="text" 
                                   wire:model.live.debounce.300ms="searchQuery" 
                                   placeholder="{{ $heroIsRtl ? 'حي، مشروع، مسبح، كود...' : 'District, project, pool...' }}" 
                                   class="w-full bg-transparent text-xs sm:text-sm font-semibold text-slate-900 outline-none border-0 p-0 focus:ring-0">
                        </div>
                    </div>

                    {{-- 5. Search CTA Button --}}
                    <div class="md:col-span-2 flex items-center">
                        <button type="submit" 
                                class="w-full h-full min-h-[50px] rounded-xl sm:rounded-2xl bg-gradient-to-r from-[#00AEEF] to-[#0077B6] hover:from-[#0096D6] hover:to-[#005B8C] text-white text-xs sm:text-sm font-black shadow-lg shadow-sky-500/25 hover:scale-[1.02] active:scale-[0.98] transition flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fas fa-search text-sm"></i>
                            <span>{{ $heroIsRtl ? 'بحث فوري' : 'Search' }}</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

