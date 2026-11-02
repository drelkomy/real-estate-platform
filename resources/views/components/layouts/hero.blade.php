@php
    $heroLocale = app()->getLocale();
    $heroIsRtl = $heroLocale === 'ar';

    $citiesList = [
        [
            'id' => 'riyadh',
            'name_ar' => 'الرياض',
            'name_en' => 'Riyadh',
            'lat' => 24.7136,
            'lng' => 46.6753,
            'count' => '+1,420 عقار',
            'desc' => 'العاصمة والمركز المالي الأكبر',
            'img' => 'https://images.unsplash.com/photo-1586724237569-f3d0c1dee8c6?w=600&auto=format&fit=crop&q=80',
        ],
        [
            'id' => 'dubai',
            'name_ar' => 'دبي',
            'name_en' => 'Dubai',
            'lat' => 25.2048,
            'lng' => 55.2708,
            'count' => '+2,180 عقار',
            'desc' => 'المارينا ووسط المدينة والقصور الشاطئية',
            'img' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=600&auto=format&fit=crop&q=80',
        ],
        [
            'id' => 'cairo',
            'name_ar' => 'القاهرة الجديدة',
            'name_en' => 'New Cairo',
            'lat' => 30.0263,
            'lng' => 31.4913,
            'count' => '+1,950 عقار',
            'desc' => 'التجمع الخامس وأرقى الكمبوندات',
            'img' => 'https://images.unsplash.com/photo-1572252009286-268acec5ca0a?w=600&auto=format&fit=crop&q=80',
        ],
        [
            'id' => 'zayed',
            'name_ar' => 'الشيخ زايد',
            'name_en' => 'Sheikh Zayed',
            'lat' => 30.0543,
            'lng' => 30.9858,
            'count' => '+760 عقار',
            'desc' => 'فيلات ومجمعات سكنية راقية',
            'img' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600&auto=format&fit=crop&q=80',
        ],
        [
            'id' => 'jeddah',
            'name_ar' => 'جدة',
            'name_en' => 'Jeddah',
            'lat' => 21.5433,
            'lng' => 39.1728,
            'count' => '+840 عقار',
            'desc' => 'الكورنيش وأبحر الشمالية والقصور',
            'img' => 'https://images.unsplash.com/photo-1578895101408-1a36b834405b?w=600&auto=format&fit=crop&q=80',
        ],
        [
            'id' => 'khobar',
            'name_ar' => 'الخبر',
            'name_en' => 'Al Khobar',
            'lat' => 26.2172,
            'lng' => 50.1971,
            'count' => '+520 عقار',
            'desc' => 'الواجهة البحرية والمنطقة الشرقية',
            'img' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&auto=format&fit=crop&q=80',
        ],
    ];

    $propertyTypes = [
        'all' => ['label' => 'جميع الأنواع', 'label_en' => 'All Types'],
        'villas' => ['label' => 'فلل وقصور فاخرة', 'label_en' => 'Luxury Villas & Mansions'],
        'apartments' => ['label' => 'شقق وبنتهاوس', 'label_en' => 'Apartments & Penthouses'],
        'duplex' => ['label' => 'دوبلكس وتاون هاوس', 'label_en' => 'Duplex & Townhouses'],
        'chalets' => ['label' => 'شاليهات ومنتجعات', 'label_en' => 'Chalets & Resorts'],
        'commercial' => ['label' => 'أبراج ومكاتب تجارية', 'label_en' => 'Commercial Towers'],
        'lands' => ['label' => 'مخططات وأراضي استثمارية', 'label_en' => 'Investment Lands'],
    ];
@endphp

{{-- ===== Dynamic Interactive Map Hero Component ===== --}}
<div class="relative w-full bg-[#071529] font-cairo overflow-visible z-30"
     dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}"
     x-data="{
         cities: @js($citiesList),
         activeCity: '{{ $selectedCity ?? '' }}',
         map: null,
         init() {
             this.$nextTick(() => {
                 if (window.initHeroInteractiveMap) {
                     this.map = window.initHeroInteractiveMap('interactive-hero-map', this.cities);
                 } else {
                     setTimeout(() => {
                         if (window.initHeroInteractiveMap) {
                             this.map = window.initHeroInteractiveMap('interactive-hero-map', this.cities);
                         }
                     }, 200);
                 }
             });
             window.addEventListener('select-hero-city', (e) => {
                 this.flyToCity(e.detail);
             });
         },
         flyToCity(cityId) {
             this.activeCity = cityId;
             const found = this.cities.find(c => c.id === cityId);
             if (found && this.map) {
                 this.map.flyTo([found.lat, found.lng], 9, {
                     duration: 1.2,
                     easeLinearity: 0.25
                 });
                 if (found._marker) {
                     setTimeout(() => {
                         found._marker.openPopup();
                     }, 1250);
                 }
             }
             const sel = document.getElementById('hero-city-select');
             if (sel && sel.value !== cityId) {
                 sel.value = cityId;
                 sel.dispatchEvent(new Event('change', { bubbles: true }));
             }
         },
         resetMapView() {
             this.activeCity = '';
             if (this.map) {
                 this.map.flyTo([25.8, 43.5], 5, { duration: 1.0 });
                 this.map.closePopup();
             }
             const sel = document.getElementById('hero-city-select');
             if (sel && sel.value !== '') {
                 sel.value = '';
                 sel.dispatchEvent(new Event('change', { bubbles: true }));
             }
         }
     }">

    {{-- Map Canvas Container --}}
    <div class="relative w-full h-[480px] sm:h-[540px] lg:h-[580px] bg-slate-900">
        <div id="interactive-hero-map" class="w-full h-full z-10" style="min-height: 480px; width: 100%;"></div>

        {{-- Top Floating Overlay Banner with Title & Quick Switch Pills --}}
        <div class="absolute top-4 sm:top-6 inset-x-0 z-[500] pointer-events-none">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3 bg-[#071529]/90 backdrop-blur-md border border-[#D4AF37]/35 rounded-2xl p-3 sm:px-5 sm:py-3 shadow-xl pointer-events-auto">

                    {{-- Title & Info --}}
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#D4AF37]/20 text-[#D4AF37] flex items-center justify-center text-sm shrink-0">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div>
                            <h2 class="text-xs sm:text-sm font-black text-white leading-tight flex items-center gap-2">
                                <span>{{ $heroIsRtl ? 'الخريطة التفاعلية للمواقع والعقارات' : 'Interactive Real Estate Map' }}</span>
                                <span class="hidden md:inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            </h2>
                            <p class="text-[10.5px] sm:text-xs text-slate-300 font-medium">
                                {{ $heroIsRtl ? 'انقر على أي مدينة للتنقل المباشر واستكشاف العقارات المتاحة' : 'Click on any city marker to explore verified listings' }}
                            </p>
                        </div>
                    </div>

                    {{-- Quick City Pills & Reset View Button --}}
                    <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar max-w-full">
                        <button type="button"
                                @click="resetMapView()"
                                class="px-2.5 py-1 rounded-lg text-[11px] font-bold transition cursor-pointer shrink-0"
                                :class="!activeCity ? 'bg-[#D4AF37] text-slate-950 font-black shadow-xs' : 'bg-white/10 hover:bg-white/20 text-white'">
                            <i class="fas fa-globe-americas text-[10px] me-1"></i>
                            <span>{{ $heroIsRtl ? 'الكل' : 'All' }}</span>
                        </button>
                        @foreach($citiesList as $c)
                            <button type="button"
                                    @click="flyToCity('{{ $c['id'] }}')"
                                    class="px-2.5 py-1 rounded-lg text-[11px] font-bold transition cursor-pointer shrink-0"
                                    :class="activeCity === '{{ $c['id'] }}' ? 'bg-[#D4AF37] text-slate-950 font-black shadow-xs' : 'bg-white/10 hover:bg-white/20 text-white'">
                                <span>{{ $heroIsRtl ? $c['name_ar'] : $c['name_en'] }}</span>
                            </button>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Floating Search Filter Capsule Overlapping the Bottom of the Map --}}
    <div class="relative max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 -mt-10 sm:-mt-12 lg:-mt-14 z-30 mb-2 sm:mb-4 lg:mb-0" dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}">
        <div class="bg-[#D4AF37] p-1 sm:p-1.5 rounded-2xl shadow-2xl">
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
                        <select id="hero-city-select"
                                wire:model.live="selectedCity"
                                @change="flyToCity($event.target.value)"
                                class="w-full bg-transparent text-xs sm:text-sm font-black text-slate-900 outline-none border-0 p-0 focus:ring-0 cursor-pointer">
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
                            <option value="all" class="text-slate-900 font-bold">{{ $heroIsRtl ? 'الكل (شراء وإيجار)' : 'All' }}</option>
                            <option value="sale" class="text-slate-900 font-bold">{{ $heroIsRtl ? 'شراء' : 'For Sale' }}</option>
                            <option value="rent" class="text-slate-900 font-bold">{{ $heroIsRtl ? 'إيجار' : 'For Rent' }}</option>
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
                            @foreach($propertyTypes as $k => $c)
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
                        <span>{{ __('Search') }}</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
