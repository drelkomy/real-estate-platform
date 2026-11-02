@php
    $isRtl = app()->getLocale() === 'ar';
@endphp

<div>
    {{-- 1. Signature Hero Section with Floating Search Capsule (ملف منفصل مستقل) --}}
    @include('components.layouts.hero')

    {{-- 2. Developed Categories Showcase Section (ملف منفصل مستقل - منقولة للأسفل ومطورة) --}}
    @include('components.layouts.categories-showcase')

    {{-- 3. Top Cities / Destinations Section --}}
    <section id="destinations" class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 font-cairo">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
            <div>
                <span class="text-xs sm:text-sm font-black text-[#D4AF37] uppercase tracking-wider block mb-1 flex items-center gap-1.5">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ __('home.destinations_badge') }}</span>
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-tight">
                    {{ __('home.destinations_title') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 font-medium">
                    {{ __('home.destinations_subtitle') }}
                </p>
            </div>
            @if(!empty($selectedCity))
                <button type="button"
                        wire:click="$set('selectedCity', '')"
                        class="ta-btn ta-btn-sm ta-btn-outline cursor-pointer self-start sm:self-auto">
                    <i class="fas fa-th-large text-[#D4AF37]"></i>
                    <span>{{ __('home.show_all_cities') }}</span>
                </button>
            @endif
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
            @php
                $destinations = [
                    ['id' => 'new_cairo', 'name' => $isRtl ? 'القاهرة الجديدة' : 'New Cairo', 'count' => 1850, 'img' => 'https://images.unsplash.com/photo-1572252009286-268acec5ca0a?auto=format&fit=crop&w=600&q=80'],
                    ['id' => 'sheikh_zayed', 'name' => $isRtl ? 'الشيخ زايد' : 'Sheikh Zayed', 'count' => 1420, 'img' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=600&q=80'],
                    ['id' => 'new_capital', 'name' => $isRtl ? 'العاصمة الإدارية' : 'New Capital', 'count' => 980, 'img' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=600&q=80'],
                    ['id' => 'north_coast', 'name' => $isRtl ? 'الساحل الشمالي' : 'North Coast', 'count' => 760, 'img' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80'],
                    ['id' => 'gouna', 'name' => $isRtl ? 'الجونة' : 'El Gouna', 'count' => 540, 'img' => 'https://images.unsplash.com/photo-1580674684081-7617fbf3d745?auto=format&fit=crop&w=600&q=80'],
                    ['id' => 'zamalek', 'name' => $isRtl ? 'الزمالك' : 'Zamalek', 'count' => 620, 'img' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=600&q=80'],
                ];
            @endphp

            @foreach($destinations as $dest)
                @php
                    $isCityActive = (($selectedCity ?? '') === $dest['id']);
                @endphp
                <div wire:click="$set('selectedCity', '{{ $isCityActive ? '' : $dest['id'] }}')"
                     class="group relative h-40 sm:h-48 rounded-2xl overflow-hidden cursor-pointer shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 {{ $isCityActive ? 'ring-4 ring-[#D4AF37] scale-[1.03]' : 'border border-slate-200/80 hover:border-[#D4AF37]/50' }}">
                    <img src="{{ $dest['img'] }}" alt="{{ $dest['name'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/30 to-transparent"></div>

                    @if($isCityActive)
                        <div class="absolute top-2.5 {{ $isRtl ? 'right-2.5' : 'left-2.5' }} bg-gradient-to-r from-[#E5C158] to-[#D4AF37] text-slate-950 text-[10px] font-black px-2.5 py-0.5 rounded-full flex items-center gap-1 shadow-md">
                            <i class="fas fa-check text-[9px]"></i>
                            <span>{{ __('home.active_badge') }}</span>
                        </div>
                    @endif

                    <div class="absolute bottom-2.5 inset-x-2.5 text-white">
                        <h3 class="font-black text-xs sm:text-sm text-white group-hover:text-[#F3E5AB] transition-colors leading-tight">
                            {{ $dest['name'] }}
                        </h3>
                        <p class="text-[10px] text-slate-300 font-semibold mt-0.5 flex items-center gap-1">
                            <i class="fas fa-building text-[#D4AF37] text-[9px]"></i>
                            <span>{{ number_format($dest['count']) }} {{ __('home.units') }}</span>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 4. Featured Properties Grid Section --}}
    <section id="featured-properties" class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 font-cairo">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-6 border-b border-slate-200">
            <div>
                <span class="text-xs sm:text-sm font-black text-[#D4AF37] uppercase tracking-wider block mb-1 flex items-center gap-1.5">
                    <i class="fas fa-crown text-xs"></i>
                    <span>{{ __('home.listings_badge') }}</span>
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-tight">
                    {{ __('home.listings_title') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 font-medium">
                    {{ __('home.showing_count', ['count' => ($totalCount ?? (isset($properties) ? $properties->count() : 0))]) }}
                </p>
            </div>

            {{-- Quick Purpose Filter Switch in Deep Navy & Gold --}}
            <div class="flex items-center gap-2 self-start md:self-auto p-1 rounded-2xl bg-slate-100 border border-slate-200">
                <button type="button"
                        wire:click="setPurpose('all')"
                        class="px-4 py-2 rounded-xl text-xs font-black transition cursor-pointer {{ $purpose === 'all' ? 'bg-[#071529] text-[#D4AF37] shadow-sm border border-[#D4AF37]/30' : 'text-slate-700 hover:text-slate-950' }}">
                    {{ __('home.filter_all') }}
                </button>
                <button type="button"
                        wire:click="setPurpose('sale')"
                        class="px-4 py-2 rounded-xl text-xs font-black transition cursor-pointer {{ $purpose === 'sale' ? 'bg-[#071529] text-[#D4AF37] shadow-sm border border-[#D4AF37]/30' : 'text-slate-700 hover:text-slate-950' }}">
                    {{ __('home.filter_sale') }}
                </button>
                <button type="button"
                        wire:click="setPurpose('rent')"
                        class="px-4 py-2 rounded-xl text-xs font-black transition cursor-pointer {{ $purpose === 'rent' ? 'bg-[#071529] text-[#D4AF37] shadow-sm border border-[#D4AF37]/30' : 'text-slate-700 hover:text-slate-950' }}">
                    {{ __('home.filter_rent') }}
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
                <h3 class="font-black text-lg text-slate-800">{{ __('home.no_properties') }}</h3>
                <p class="text-xs text-slate-500 mt-1">{{ __('home.no_properties_hint') }}</p>
                <button type="button"
                        wire:click="$set('selectedCategory', 'all'); $set('selectedCity', ''); $set('purpose', 'all'); $set('searchQuery', '');"
                        class="mt-4 px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#E5C158] via-[#D4AF37] to-[#AA7C11] text-slate-950 text-xs font-black shadow-md cursor-pointer">
                    <i class="fas fa-redo text-xs me-1"></i>
                    <span>{{ __('home.reset_filters') }}</span>
                </button>
            </div>
        @endif
    </section>

    {{-- 5. Call To Action: List Your Property in Midnight Navy & Gold --}}
    <section class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-10 font-cairo">
        <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-r from-[#071529] via-[#0A1B33] to-[#040D1A] text-white shadow-2xl flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden border-2 border-[#D4AF37]/30">
            <div class="relative z-10 max-w-xl">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-[#D4AF37]/15 text-[#F3E5AB] text-xs font-black mb-3 border border-[#D4AF37]/30">
                    <i class="fas fa-bullhorn text-[#D4AF37]"></i>
                    {{ __('home.cta_badge') }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-black tracking-tight leading-tight">
                    {{ __('home.cta_title') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 mt-2 leading-relaxed">
                    {{ __('home.cta_subtitle') }}
                </p>
            </div>
            <div class="relative z-10 flex flex-wrap gap-3">
                <a href="{{ route('register') }}" class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-[#E5C158] via-[#D4AF37] to-[#AA7C11] hover:from-[#F3E5AB] hover:to-[#D4AF37] text-slate-950 text-sm font-black shadow-lg shadow-amber-500/25 transition">
                    <i class="fas fa-plus-circle me-1.5"></i>
                    <span>{{ __('home.cta_add_property') }}</span>
                </a>
                <a href="{{ route('login') }}" class="px-6 py-3.5 rounded-2xl bg-white/5 hover:bg-white/10 text-white text-sm font-bold transition border border-[#D4AF37]/40">
                    <span>{{ __('home.cta_agent_portal') }}</span>
                </a>
            </div>
        </div>
    </section>

</div>
