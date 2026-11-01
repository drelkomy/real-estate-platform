@php
    $isRtl = app()->getLocale() === 'ar';
@endphp

@if (isset($paginator))
    <div class="ta-pagination" style="width:100%;border-top:1.5px solid #CBD5E1;padding:14px 20px;">
        
        {{-- Summary info --}}
        <div class="ta-pagination-info">
            {{ __('Showing') }} <span style="font-weight:700;color:#0F172A;" class="dark:text-white">{{ $paginator->firstItem() ?? 0 }}</span>
            {{ __('to') }} <span style="font-weight:700;color:#0F172A;" class="dark:text-white">{{ $paginator->lastItem() ?? 0 }}</span>
            {{ __('of') }} <span style="font-weight:700;color:#0F172A;" class="dark:text-white">{{ $paginator->total() }}</span> {{ __('results') }}
        </div>

        {{-- Buttons: Previous / Numbers / Next --}}
        <div class="ta-pagination-btns" style="display:flex;align-items:center;gap:6px;">
            
            {{-- Previous Page ("السابق") --}}
            @if ($paginator->onFirstPage())
                <button disabled class="ta-page-btn" style="width:auto;padding:0 14px;opacity:0.4;cursor:not-allowed;">
                    <i class="fas {{ __('fa-chevron-left') }}" style="font-size:11px;"></i>
                    <span style="margin-{{ __('left') }}:6px;font-weight:600;">{{ __('Previous') }}</span>
                </button>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled" class="ta-page-btn" style="width:auto;padding:0 14px;">
                    <i class="fas {{ __('fa-chevron-left') }}" style="font-size:11px;"></i>
                    <span style="margin-{{ __('left') }}:6px;font-weight:600;">{{ __('Previous') }}</span>
                </button>
            @endif

            {{-- Numeric Page Links (if available) --}}
            @if(isset($elements))
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="ta-page-btn" style="opacity:0.6;cursor:default;">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <button class="ta-page-btn active" style="font-weight:700;">{{ $page }}</button>
                            @else
                                <button wire:click="gotoPage({{ $page }})" class="ta-page-btn">{{ $page }}</button>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @else
                <button class="ta-page-btn active" style="font-weight:700;">1</button>
            @endif

            {{-- Next Page ("التالي") --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled" class="ta-page-btn" style="width:auto;padding:0 14px;">
                    <span style="margin-{{ __('right') }}:6px;font-weight:600;">{{ __('Next') }}</span>
                    <i class="fas {{ __('fa-chevron-right') }}" style="font-size:11px;"></i>
                </button>
            @else
                <button disabled class="ta-page-btn" style="width:auto;padding:0 14px;opacity:0.4;cursor:not-allowed;">
                    <span style="margin-{{ __('right') }}:6px;font-weight:600;">{{ __('Next') }}</span>
                    <i class="fas {{ __('fa-chevron-right') }}" style="font-size:11px;"></i>
                </button>
            @endif

        </div>

    </div>
@endif
