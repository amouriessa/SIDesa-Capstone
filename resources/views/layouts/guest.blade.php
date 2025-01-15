<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Desa Sidorejo</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <link rel="icon" type="image/png" href="{{ asset('images/landingpage/logo.png') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0 dark:bg-gray-900"
            style="background-image: url('{{ asset('images/landingpage/kalurahann.png') }}'); background-size: cover; background-position: center;">

            <div class="absolute inset-0 min-h-screen bg-black bg-opacity-10 backdrop-blur-sm"></div>

            <div class="relative z-10 w-full px-10 py-5 mx-auto overflow-hidden scale-90 bg-white shadow-xl sm:max-w-md dark:bg-gray-800 sm:rounded-2xl">
                <div class="mb-4 text-center">
                    <a href="/">
                        <img src="{{ asset('images/landingpage/logo.png') }}" alt="Logo" class="w-10 h-10 mx-auto">
                    </a>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
