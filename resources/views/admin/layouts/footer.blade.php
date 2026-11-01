@php
    $siteName = config('app.name', 'Real Estate Platform');
@endphp
<footer style="padding: 1.25rem 2rem; text-align: center; font-size: 0.8125rem; font-weight: 600; color: #64748B; border-top: 1.5px solid #CBD5E1;"
        class="bg-white dark:bg-[#1C1A17] dark:border-white/10 dark:text-slate-400">
    {{ __('All Rights Reserved') }} &copy; {{ date('Y') }} <span style="font-weight:700;" class="text-[#003580] dark:text-[#38BDF8]">{{ $siteName }}</span>
</footer>
