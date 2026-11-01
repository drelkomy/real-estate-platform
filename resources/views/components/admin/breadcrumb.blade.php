@props([
    'title' => '',
    'subtitle' => null,
    'breadcrumbs' => [],
])

@php
    $isRtl = app()->getLocale() === 'ar';
@endphp

<div class="ta-page-header">
    <div>
        @if($title)
            <h1 class="ta-page-title">{{ $title }}</h1>
        @endif
        @if($subtitle)
            <p class="ta-page-subtitle">{{ $subtitle }}</p>
        @endif
    </div>

    @if(!empty($breadcrumbs))
        <nav class="ta-breadcrumb">
            <a href="{{ url('/admin') }}" class="ta-breadcrumb-link">
                <i class="fas fa-home" style="font-size:0.75rem;margin-{{ __('right') }}:4px;"></i>
                {{ __('Dashboard') }}
            </a>

            @foreach($breadcrumbs as $item)
                <span class="ta-breadcrumb-sep">
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none">
                        <path d="{{ __('M1 1l4 4-4 4') }}" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>

                @if(!$loop->last && !empty($item['url']))
                    <a href="{{ $item['url'] }}" class="ta-breadcrumb-link">{{ $item['label'] }}</a>
                @else
                    <span class="ta-breadcrumb-current">{{ $item['label'] ?? $item }}</span>
                @endif
            @endforeach
        </nav>
    @endif
</div>
