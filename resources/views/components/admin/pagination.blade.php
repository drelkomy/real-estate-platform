@props(['paginator' => null])

@php
    $isRtl = app()->getLocale() === 'ar';
@endphp

@if (isset($paginator))
    <div class="ta-pagination" style="width:100%;border-top:1.5px solid #CBD5E1;padding:14px 20px;">
        
        {{-- Results Info --}}
        <div class="ta-pagination-info">
            {{ __('Showing') }} <span style="font-weight:700;color:#0F172A;" class="dark:text-white">{{ $paginator->firstItem() ?? 0 }}</span>
            {{ __('to') }} <span style="font-weight:700;color:#0F172A;" class="dark:text-white">{{ $paginator->lastItem() ?? 0 }}</span>
            {{ __('of') }} <span style="font-weight:700;color:#0F172A;" class="dark:text-white">{{ $paginator->total() }}</span> {{ __('results') }}
        </div>

        {{-- Pagination Buttons --}}
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
