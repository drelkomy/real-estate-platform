<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="{{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 Internal Server Error | TailAdmin</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 font-cairo min-h-screen flex flex-col items-center justify-center p-6 antialiased relative">

    <div class="max-w-md w-full text-center space-y-6">
        
        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-red-50 text-red-600 dark:bg-red-950/40 dark:text-red-400 text-4xl shadow-inner">
            <i class="fas fa-server"></i>
        </div>

        <div>
            <span class="text-xs font-black uppercase tracking-widest text-red-500">[ Error 500 ]</span>
            <h1 class="text-4xl font-black text-gray-800 dark:text-white mt-1">500</h1>
            <h2 class="text-xl font-bold text-gray-700 dark:text-gray-200 mt-2">{{ __('Internal Server Error') }}</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 leading-relaxed max-w-xs mx-auto">
                {{ __('Something went wrong on our server. Our technical team has been notified.') }}
            </p>
        </div>

        <div class="flex items-center justify-center gap-3 pt-2">
            <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), '/') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#3E6554] hover:bg-[#ECAA25] text-white text-xs font-extrabold shadow-lg transition-all border-0">
                <i class="fas {{ app()->getLocale() === 'ar' ? 'fa-arrow-right' : 'fa-arrow-left' }} text-xs"></i>
                <span>{{ __('Return to Home Page') }}</span>
            </a>
        </div>

    </div>

    <p class="absolute bottom-6 text-xs text-gray-400 font-medium">
        &copy; {{ date('Y') }} TailAdmin - {{ config('app.name', 'Real Estate Platform') }}
    </p>

</body>
</html>
