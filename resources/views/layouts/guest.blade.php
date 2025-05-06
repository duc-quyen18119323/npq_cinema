<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased" style="position:relative; min-height:100vh;">
    <!-- BG image for cinema ticket website -->
    <div style="
        position:fixed;
        top:0;left:0;width:100vw;height:100vh;
        z-index:0;
        background: url('https://images.unsplash.com/photo-1517602302552-471fe67acf66?auto=format&fit=crop&w=1500&q=80') center center/cover no-repeat;
        filter: blur(4px) brightness(0.7);
        "></div>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="z-index:1; position:relative;">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white bg-opacity-90 shadow-md overflow-hidden sm:rounded-lg" style="z-index:2;">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
