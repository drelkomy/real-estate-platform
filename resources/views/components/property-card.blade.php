@props(['property'])

@php
    $isRtl = app()->getLocale() === 'ar';
    $purpose = $property['purpose'] ?? 'sale'; // 'sale' or 'rent'
    $price = $property['price'] ?? 0;
    $currency = $property['currency'] ?? ($isRtl ? 'ر.س' : 'SAR');
    $priceFormatted = number_format($price) . ' ' . $currency;
    if ($purpose === 'rent') {
        $priceFormatted .= ' / ' . ($isRtl ? 'سنوياً' : 'yr');
    }
    $whatsappPhone = '966500000000';
    $whatsappText = urlencode(($isRtl ? 'مرحباً، أود الاستفسار عن العقار: ' : 'Hello, I want to inquire about: ') . ($property['title'] ?? ''));
    $whatsappUrl = "https://wa.me/{$whatsappPhone}?text={$whatsappText}";
@endphp

<div class="group bg-white rounded-3xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-2xl hover:border-[#D4AF37]/50 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">

    {{-- Card Image & Overlays --}}
    <div class="relative h-56 sm:h-64 overflow-hidden bg-slate-100">
        {{-- Thumbnail --}}
        <img src="{{ $property['image'] }}"
             alt="{{ $property['title'] }}"
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
             loading="lazy">

        {{-- Dark Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-transparent to-transparent pointer-events-none"></div>

        {{-- Top Badges Row --}}
        <div class="absolute top-3 inset-x-3 flex items-center justify-between z-10">
            {{-- Purpose Badge (Sale / Rent) in Navy & Gold --}}
            <div class="flex items-center gap-1.5">
                <span class="px-3 py-1 rounded-full text-xs font-black shadow-sm {{ $purpose === 'sale' ? 'bg-[#071529] text-[#D4AF37] border border-[#D4AF37]/40' : 'bg-emerald-600 text-white' }}">
                    {{ $purpose === 'sale' ? ($isRtl ? 'للبيع' : 'For Sale') : ($isRtl ? 'للإيجار' : 'For Rent') }}
                </span>
                @if(!empty($property['is_featured']))
                    <span class="px-2.5 py-1 rounded-full bg-gradient-to-r from-[#E5C158] via-[#D4AF37] to-[#AA7C11] text-slate-950 text-[11px] font-black shadow-sm flex items-center gap-1">
                        <i class="fas fa-crown text-[10px]"></i>
                        <span>{{ $isRtl ? 'VIP مميز' : 'VIP' }}</span>
                    </span>
                @endif
            </div>

            {{-- Wishlist Heart Button --}}
            <button type="button"
                    class="w-8 h-8 rounded-full bg-white/90 backdrop-blur-md hover:bg-white text-slate-600 hover:text-rose-500 shadow-md flex items-center justify-center transition-transform hover:scale-110 cursor-pointer"
                    title="{{ __('Add to Favorites') }}">
                <i class="fas fa-heart text-xs"></i>
            </button>
        </div>

        {{-- Bottom Overlay Tag: Verified FAL License --}}
        <div class="absolute bottom-3 {{ $isRtl ? 'right-3' : 'left-3' }} z-10 flex items-center gap-1.5">
            <span class="px-2.5 py-0.5 rounded-md bg-[#071529]/90 backdrop-blur-md text-[#F3E5AB] border border-[#D4AF37]/40 text-[10px] font-black shadow-xs flex items-center gap-1">
                <i class="fas fa-certificate text-[#D4AF37]"></i>
                <span>{{ $isRtl ? 'معلن موثق فال' : 'Verified Broker' }}</span>
            </span>
        </div>
    </div>

    {{-- Card Body --}}
    <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
        <div>
            {{-- Property Type & District --}}
            <div class="flex items-center justify-between gap-2 mb-2 text-xs">
                <span class="font-extrabold text-[#AA7C11] uppercase tracking-wider flex items-center gap-1">
                    <i class="fas fa-tag text-[10px]"></i>
                    <span>{{ $property['category_name'] ?? __('Property') }}</span>
                </span>
                <span class="text-slate-400 font-mono text-[11px]">
                    #{{ $property['reference_id'] ?? rand(1000, 9999) }}
                </span>
            </div>

            {{-- Title --}}
            <h3 class="font-black text-sm sm:text-base text-slate-900 group-hover:text-[#AA7C11] transition-colors leading-snug line-clamp-1 mb-1.5">
                {{ $property['title'] }}
            </h3>

            {{-- Location --}}
            <p class="text-xs text-slate-500 flex items-center gap-1 line-clamp-1 mb-3">
                <i class="fas fa-map-marker-alt text-[#D4AF37] text-[11px] shrink-0"></i>
                <span>{{ $property['location'] }}</span>
            </p>

            {{-- Key Specs: Beds, Baths, Area --}}
            <div class="grid grid-cols-3 gap-2 py-2.5 border-y border-slate-100 text-center mb-3 bg-slate-50/50 rounded-xl">
                <div class="flex flex-col items-center">
                    <span class="text-[11px] text-slate-400 flex items-center gap-1"><i class="fas fa-bed text-[#D4AF37]"></i> {{ $isRtl ? 'غرف' : 'Beds' }}</span>
                    <span class="text-xs font-black text-slate-800 mt-0.5">{{ $property['bedrooms'] ?? '—' }}</span>
                </div>
                <div class="flex flex-col items-center border-x border-slate-200/80">
                    <span class="text-[11px] text-slate-400 flex items-center gap-1"><i class="fas fa-bath text-[#D4AF37]"></i> {{ $isRtl ? 'حمامات' : 'Baths' }}</span>
                    <span class="text-xs font-black text-slate-800 mt-0.5">{{ $property['bathrooms'] ?? '—' }}</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-[11px] text-slate-400 flex items-center gap-1"><i class="fas fa-vector-square text-[#D4AF37]"></i> {{ $isRtl ? 'المساحة' : 'Area' }}</span>
                    <span class="text-xs font-black text-slate-800 mt-0.5">{{ $property['area'] ?? '—' }} م²</span>
                </div>
            </div>
        </div>

        {{-- Price & Action Buttons --}}
        <div>
            {{-- Price Row --}}
            <div class="flex items-baseline justify-between gap-2 mb-3">
                <div>
                    <span class="text-[11px] text-slate-400 block font-bold">{{ $isRtl ? 'السعر المطلوب:' : 'Price:' }}</span>
                    <span class="text-base sm:text-lg font-black text-[#071529] tracking-tight">
                        {{ $priceFormatted }}
                    </span>
                </div>
                <span class="text-[10px] font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                    {{ $isRtl ? 'قابل للتفاوض' : 'Negotiable' }}
                </span>
            </div>

            {{-- Action Buttons --}}
            <div class="grid grid-cols-2 gap-2">
                {{-- Direct WhatsApp --}}
                <a href="{{ $whatsappUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="py-2.5 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black text-center transition shadow-xs flex items-center justify-center gap-1.5 cursor-pointer">
                    <i class="fab fa-whatsapp text-sm"></i>
                    <span>{{ $isRtl ? 'واتساب' : 'WhatsApp' }}</span>
                </a>

                {{-- View Details --}}
                <a href="#"
                   class="py-2.5 px-3 rounded-xl bg-slate-100 hover:bg-[#071529] hover:text-[#D4AF37] hover:border hover:border-[#D4AF37]/50 text-slate-800 text-xs font-black text-center transition flex items-center justify-center gap-1.5 cursor-pointer">
                    <span>{{ $isRtl ? 'التفاصيل' : 'Details' }}</span>
                    <i class="fas {{ $isRtl ? 'fa-arrow-left' : 'fa-arrow-right' }} text-[10px]"></i>
                </a>
            </div>
        </div>

    </div>

</div>
