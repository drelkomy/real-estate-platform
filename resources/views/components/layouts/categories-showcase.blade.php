@php
    $catLocale = app()->getLocale();
    $catIsRtl = $catLocale === 'ar';

    $categoriesList = [
        [
            'id' => 'villas',
            'title_ar' => 'فلل وقصور فاخرة',
            'title_en' => 'Luxury Villas & Mansions',
            'count' => '+850 عقار متاح',
            'count_en' => '850+ Properties',
            'icon' => 'fa-landmark',
            'color' => '#D4AF37',
        ],
        [
            'id' => 'apartments',
            'title_ar' => 'شقق وبنتهاوس عصرية',
            'title_en' => 'Apartments & Penthouses',
            'count' => '+1,420 عقار متاح',
            'count_en' => '1,420+ Properties',
            'icon' => 'fa-building',
            'color' => '#AA7C11',
        ],
        [
            'id' => 'duplex',
            'title_ar' => 'دوبلكس وتاون هاوس',
            'title_en' => 'Duplex & Townhouses',
            'count' => '+620 عقار متاح',
            'count_en' => '620+ Properties',
            'icon' => 'fa-layer-group',
            'color' => '#D4AF37',
        ],
        [
            'id' => 'chalets',
            'title_ar' => 'شاليهات ومنتجعات ساحلية',
            'title_en' => 'Chalets & Resorts',
            'count' => '+410 عقار متاح',
            'count_en' => '410+ Properties',
            'icon' => 'fa-umbrella-beach',
            'color' => '#AA7C11',
        ],
        [
            'id' => 'commercial',
            'title_ar' => 'أبراج ومكاتب تجارية',
            'title_en' => 'Commercial Towers',
            'count' => '+380 عقار متاح',
            'count_en' => '380+ Properties',
            'icon' => 'fa-briefcase',
            'color' => '#D4AF37',
        ],
        [
            'id' => 'lands',
            'title_ar' => 'مخططات وأراضي استثمارية',
            'title_en' => 'Investment Lands',
            'count' => '+290 عقار متاح',
            'count_en' => '290+ Properties',
            'icon' => 'fa-map-marked-alt',
            'color' => '#AA7C11',
        ],
    ];
@endphp

{{-- ===== Developed Interactive Categories Section (Moved Below Hero) ===== --}}
<section id="categories" class="relative max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 pt-10 sm:pt-14 pb-6 font-cairo"
         dir="{{ $catIsRtl ? 'rtl' : 'ltr' }}">

    {{-- Section Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 mb-6">
        <div>
            <span class="text-xs sm:text-sm font-black text-[#AA7C11] uppercase tracking-wider block mb-1 flex items-center gap-1.5">
                <i class="fas fa-th-large text-xs text-[#D4AF37]"></i>
                <span>{{ $catIsRtl ? 'تصفح حسب نوع العقار' : 'Explore by Category' }}</span>
            </span>
            <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight leading-tight">
                {{ $catIsRtl ? 'اختر العقار المناسب لاحتياجاتك' : 'Find The Perfect Property For Your Needs' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 mt-1 font-medium">
                {{ $catIsRtl ? 'عقارات متنوعة موثقة برخص رسمية ومطابقة لأعلى معايير الجودة' : 'Verified residential & commercial real estate meeting highest standards' }}
            </p>
        </div>

        @if(($selectedCategory ?? 'all') !== 'all')
            <button type="button"
                    wire:click="setCategory('all')"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition cursor-pointer self-start sm:self-auto">
                <i class="fas fa-times text-[10px]"></i>
                <span>{{ $catIsRtl ? 'عرض كل التصنيفات' : 'View All Categories' }}</span>
            </button>
        @endif
    </div>

    {{-- Cards Grid (6 Enhanced Interactive Category Cards) --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
        @foreach($categoriesList as $item)
            @php
                $isActive = ($selectedCategory ?? 'all') === $item['id'];
            @endphp
            <div wire:click="setCategory('{{ $item['id'] }}')"
                 class="group p-4 sm:p-5 rounded-2xl border transition-all duration-300 cursor-pointer flex flex-col justify-between items-center text-center select-none {{ $isActive ? 'bg-[#071529] text-white border-[#D4AF37] ring-2 ring-[#D4AF37]/50 shadow-lg scale-[1.02]' : 'bg-white hover:bg-slate-50 text-slate-900 border-slate-200/90 hover:border-[#D4AF37]/50 hover:shadow-md hover:-translate-y-0.5' }}">

                {{-- Category Icon Container --}}
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl mb-3 transition-colors duration-300 {{ $isActive ? 'bg-[#D4AF37] text-slate-950 shadow-sm' : 'bg-slate-100 group-hover:bg-[#071529] text-[#AA7C11] group-hover:text-[#D4AF37]' }}">
                    <i class="fas {{ $item['icon'] }}"></i>
                </div>

                {{-- Category Title --}}
                <h3 class="font-black text-xs sm:text-sm leading-snug mb-1 {{ $isActive ? 'text-white' : 'text-slate-900 group-hover:text-[#071529]' }}">
                    {{ $catIsRtl ? $item['title_ar'] : $item['title_en'] }}
                </h3>

                {{-- Available Count Badge --}}
                <span class="inline-block text-[10.5px] sm:text-[11px] font-bold px-2.5 py-0.5 rounded-full mt-1.5 transition-colors {{ $isActive ? 'bg-white/15 text-[#F3E5AB]' : 'bg-slate-100 group-hover:bg-[#D4AF37]/15 text-slate-500 group-hover:text-[#AA7C11]' }}">
                    {{ $catIsRtl ? $item['count'] : $item['count_en'] }}
                </span>

            </div>
        @endforeach
    </div>
</section>
