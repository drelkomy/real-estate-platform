@php
    $heroLocale = app()->getLocale();
    $heroIsRtl = $heroLocale === 'ar';

    $citiesList = [
        ['id' => 'riyadh', 'name_ar' => 'الرياض', 'name_en' => 'Riyadh'],
        ['id' => 'dubai', 'name_ar' => 'دبي', 'name_en' => 'Dubai'],
        ['id' => 'jeddah', 'name_ar' => 'جدة', 'name_en' => 'Jeddah'],
        ['id' => 'cairo', 'name_ar' => 'القاهرة الجديدة', 'name_en' => 'New Cairo'],
        ['id' => 'zayed', 'name_ar' => 'الشيخ زايد', 'name_en' => 'Sheikh Zayed'],
        ['id' => 'khobar', 'name_ar' => 'الخبر', 'name_en' => 'Al Khobar'],
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

{{-- ===== Signature Hero Section Inspired by Official Real Estate Portals ===== --}}
<div class="relative w-full bg-[#071529] text-white pt-6 sm:pt-8 lg:pt-10 pb-0 shadow-md overflow-visible z-30 font-cairo"
     dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}">

    <div class="relative max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 text-center">

        {{-- Official Certification Badge --}}
        <div class="inline-flex items-center gap-2 px-3.5 sm:px-4 py-1 rounded-full bg-[#D4AF37]/10 border border-[#D4AF37]/35 text-[#F3E5AB] text-[11px] sm:text-xs font-bold mb-3 shadow-xs">
            <i class="fas fa-shield-alt text-[#D4AF37] text-xs"></i>
            <span>{{ $heroIsRtl ? 'المنصة العقارية الرسمية المعتمدة • مرخصة برخصة فال' : 'Official FAL-Certified Luxury Real Estate Platform' }}</span>
        </div>

        {{-- Hero Headline --}}
        <div class="mb-5 sm:mb-6 max-w-3xl mx-auto">
            <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-white tracking-tight leading-tight font-cairo">
                @if($heroIsRtl)
                    منصة العقارات الفاخرة — <span class="text-[#D4AF37]">ابحث عن عقارك المثالي</span>
                @else
                    Official Luxury Real Estate — <span class="text-[#D4AF37]">Find Your Dream Property</span>
                @endif
            </h1>
            <p class="text-xs sm:text-sm md:text-base font-medium text-slate-300 mt-2 max-w-2xl mx-auto leading-relaxed">
                {{ $heroIsRtl ? 'تصفّح آلاف العقارات والقصور والفلل الموثّقة — شراء أو استثمار بثقة تامة على المنصة الرسمية' : 'Browse verified prime properties, villas, and off-market estates directly from authorized developers & brokers' }}
            </p>
        </div>

        {{-- Floating Search Filter Capsule with Imperial Gold Frame --}}
        <div class="relative z-30 translate-y-6 sm:translate-y-8 lg:translate-y-10 mb-2 sm:mb-4 lg:mb-0 text-start" dir="{{ $heroIsRtl ? 'rtl' : 'ltr' }}">
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
</div>
