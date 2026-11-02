@php
    $heroLocale = app()->getLocale();
    $heroIsRtl = $heroLocale === 'ar';

    $egyptRegions = [
        [
            'id' => 'new_cairo',
            'name' => $heroIsRtl ? 'القاهرة الجديدة والتجمع' : 'New Cairo & 5th Settlement',
            'lat' => 30.025,
            'lng' => 31.485,
        ],
        [
            'id' => 'sheikh_zayed',
            'name' => $heroIsRtl ? 'الشيخ زايد' : 'Sheikh Zayed',
            'lat' => 30.054,
            'lng' => 30.985,
        ],
        [
            'id' => 'new_capital',
            'name' => $heroIsRtl ? 'العاصمة الإدارية الجديدة' : 'New Administrative Capital',
            'lat' => 30.009,
            'lng' => 31.738,
        ],
        [
            'id' => 'october',
            'name' => $heroIsRtl ? 'السادس من أكتوبر' : '6th of October',
            'lat' => 29.988,
            'lng' => 30.942,
        ],
        [
            'id' => 'north_coast',
            'name' => $heroIsRtl ? 'الساحل الشمالي' : 'North Coast',
            'lat' => 30.952,
            'lng' => 28.784,
        ],
        [
            'id' => 'zamalek',
            'name' => $heroIsRtl ? 'الزمالك والمعادي' : 'Zamalek & Maadi',
            'lat' => 30.061,
            'lng' => 31.221,
        ],
        [
            'id' => 'gouna',
            'name' => $heroIsRtl ? 'الجونة والبحر الأحمر' : 'El Gouna & Red Sea',
            'lat' => 27.394,
            'lng' => 33.678,
        ],
    ];

    $propertyTypes = [
        'all' => __('categories.all_types'),
        'villas' => __('categories.villas'),
        'apartments' => __('categories.apartments'),
        'duplex' => __('categories.duplex'),
        'chalets' => __('categories.chalets'),
        'commercial' => __('categories.commercial'),
        'lands' => __('categories.lands'),
    ];

    $propertiesData = isset($allProperties) ? $allProperties->values()->toArray() : (isset($properties) ? $properties->values()->toArray() : []);
@endphp

{{-- ===== 3D Interactive Map Hero Component with Satellite Toggle & Real Estate Markers ===== --}}
<div class="relative w-full bg-[#071529] font-cairo overflow-visible z-30"
     dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}"
     x-data="{
         regions: @js($egyptRegions),
         properties: @js($propertiesData),
         activeCity: '{{ $selectedCity ?? '' }}',
         satelliteActive: false,
         map: null,
         init() {
             this.$nextTick(() => {
                 this.initMap();
             });
             this.$watch('$wire.selectedCity', (val) => {
                 if (val) {
                     this.flyToCity(val);
                 } else {
                     this.resetMapView();
                 }
             });
         },
         initMap() {
             if (window.initHeroInteractiveMap) {
                 this.map = window.initHeroInteractiveMap('interactive-hero-map', this.properties, this.regions);
             } else {
                 setTimeout(() => this.initMap(), 200);
             }
         },
         toggleSatelliteMode() {
             this.satelliteActive = !this.satelliteActive;
             if (this.map && this.map.toggleSatellite) {
                 this.map.toggleSatellite(this.satelliteActive);
             }
         },
         flyToCity(cityId) {
             this.activeCity = cityId;
             if (this.map && this.map.flyToCity) {
                 this.map.flyToCity(cityId);
             }
         },
         resetMapView() {
             this.activeCity = '';
             if (this.map && this.map.resetMapView) {
                 this.map.resetMapView();
             }
         }
     }">

    {{-- Map Canvas Container with Expanded Height (wire:ignore prevents Livewire re-renders from wiping 3D map DOM) --}}
    <div wire:ignore class="relative w-full h-[620px] sm:h-[700px] lg:h-[760px] bg-slate-900 overflow-hidden">
        <div id="interactive-hero-map" class="w-full h-full z-10" style="min-height: 620px; width: 100%;"></div>

        {{-- Floating Satellite View Toggle Button (زر عرض قمر صناعي) --}}
        <div class="absolute top-4 start-4 z-20 pointer-events-auto">
            <button type="button"
                    @click="toggleSatelliteMode()"
                    class="px-4 py-2.5 rounded-2xl backdrop-blur-md border text-xs font-black shadow-2xl transition-all duration-300 flex items-center gap-2 cursor-pointer hover:scale-105 active:scale-95"
                    :class="satelliteActive ? 'bg-[#071529]/95 text-[#D4AF37] border-[#D4AF37] ring-2 ring-[#D4AF37]/40' : 'bg-white/95 text-slate-900 border-slate-300/90 hover:bg-white'">
                <span x-show="!satelliteActive" class="flex items-center gap-2">
                    <i class="fas fa-satellite text-[#AA7C11] text-sm animate-pulse"></i>
                    <span>{{ __('hero.satellite_view') }}</span>
                </span>
                <span x-show="satelliteActive" class="flex items-center gap-2" x-cloak>
                    <i class="fas fa-cubes text-[#D4AF37] text-sm"></i>
                    <span>{{ __('hero.map_3d_view') }}</span>
                </span>
            </button>
        </div>
    </div>

    {{-- Floating Search Filter Capsule Overlapping the Bottom of the Map --}}
    <div class="relative max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 -mt-10 sm:-mt-12 lg:-mt-14 z-30 mb-2 sm:mb-4 lg:mb-0" dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}">
        <div class="bg-[#D4AF37] p-1 sm:p-1.5 rounded-2xl shadow-2xl">
            <form wire:submit.prevent="applySearch" class="grid grid-cols-12 lg:flex lg:flex-row lg:items-stretch gap-1 sm:gap-1.5">

                {{-- 1. City / Region Selector in Egypt --}}
                <div class="col-span-12 md:col-span-6 lg:flex-1 bg-white rounded-xl p-2.5 sm:p-3 lg:py-2 lg:px-3 flex items-center gap-2.5 relative hover:bg-slate-50 transition-colors select-none text-slate-900">
                    <div class="text-[#AA7C11] text-base sm:text-lg shrink-0">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <label class="block text-[10px] sm:text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-0.5 truncate">
                            {{ __('hero.location') }}
                        </label>
                        <select id="hero-city-select"
                                wire:model.live="selectedCity"
                                class="w-full bg-transparent text-xs sm:text-sm font-black text-slate-900 outline-none border-0 p-0 focus:ring-0 cursor-pointer">
                            <option value="" class="text-slate-900 font-bold">{{ __('hero.all_cities') }}</option>
                            @foreach($egyptRegions as $r)
                                <option value="{{ $r['id'] }}" class="text-slate-900 font-bold">{{ $r['name'] }}</option>
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
                            {{ __('hero.purpose') }}
                        </label>
                        <select wire:model.live="purpose" class="w-full bg-transparent text-xs sm:text-sm font-black text-slate-900 outline-none border-0 p-0 focus:ring-0 cursor-pointer">
                            <option value="all" class="text-slate-900 font-bold">{{ __('hero.all_purposes') }}</option>
                            <option value="sale" class="text-slate-900 font-bold">{{ __('hero.for_sale') }}</option>
                            <option value="rent" class="text-slate-900 font-bold">{{ __('hero.for_rent') }}</option>
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
                            {{ __('hero.property_type') }}
                        </label>
                        <select wire:model.live="selectedCategory" class="w-full bg-transparent text-xs sm:text-sm font-black text-slate-900 outline-none border-0 p-0 focus:ring-0 cursor-pointer">
                            @foreach($propertyTypes as $k => $label)
                                <option value="{{ $k }}" class="text-slate-900 font-bold">{{ $label }}</option>
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
                            {{ __('hero.keyword') }}
                        </label>
                        <input type="text"
                               wire:model.live.debounce.300ms="searchQuery"
                               placeholder="{{ __('hero.keyword_placeholder') }}"
                               class="w-full bg-transparent text-xs sm:text-sm font-bold text-slate-900 placeholder-slate-400 outline-none border-0 p-0 focus:ring-0">
                    </div>
                </div>

                {{-- 5. Search CTA Button in Deep Midnight Navy & Gold --}}
                <div class="col-span-12 md:col-span-4 lg:w-36 flex items-stretch">
                    <button type="submit"
                            class="w-full min-h-[46px] rounded-xl bg-[#071529] hover:bg-[#0A1B33] text-[#D4AF37] hover:text-[#F3E5AB] text-xs sm:text-sm font-black shadow-md flex items-center justify-center gap-2 transition cursor-pointer border border-[#D4AF37]/30 hover:scale-[1.02] active:scale-[0.98]">
                        <i class="fas fa-search text-xs"></i>
                        <span>{{ __('hero.search') }}</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
