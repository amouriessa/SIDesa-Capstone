<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Sidorejo</title>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/landingpage/logo.png') }}">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Tailwind CSS auto-generated styles here */
        </style>
    @endif
</head>
<body class="antialiased bg-gray-100">
    <div class="relative flex min-h-screen md:flex">
        <aside class="absolute inset-y-0 left-0 z-10 w-64 px-2 py-4 overflow-y-auto md:relative">
            @include('components/sidebar-penduduk')
        </aside>

        <div class="relative flex-1 max-w-full overflow-hidden">
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="overflow-hidden bg-white drop-shadow dark:bg-gray-800 sm:rounded-lg">
                        <div class="p-3 ml-3 text-lg font-bold text-black dark:text-gray-100">
                            {{ __("Dashboard Penduduk") }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 py-3">
                <div class="flex items-center p-4 mb-8 ml-8 bg-white border border-gray-200 rounded-lg sm:px-6 lg:px-8 drop-shadow">
                    <div class="flex-shrink-0 mr-20">
                        <img src="{{ asset('images/landingpage/birth.png') }}" alt="Kelahiran" class="w-10 h-10 ml-5">
                    </div>
                    <div class="flex flex-col space-y-1 text-center">
                        <p id="totalKelahiranPend" class="text-2xl font-bold text-gray-800">{{ $totalKelahiranPend }}</p>
                        <span class="text-xs font-light">Permohonan Surat Kelahiran Yang Anda Buat</span>
                    </div>
                </div>
                <div class="flex items-center p-4 mb-8 mr-8 bg-white border border-gray-200 rounded-lg drop-shadow sm:px-6 lg:px-8">
                    <div class="flex-shrink-0 mr-20">
                        <img src="{{ asset('images/landingpage/tombstone.png') }}" alt="Kematian" class="w-10 h-10 ml-5">
                    </div>
                    <div class="flex flex-col space-y-1 text-center">
                        <p id="totalKematianPend" class="text-2xl font-bold text-gray-800">{{ $totalKematianPend }}</p>
                        <span class="text-xs font-light">Total Permohonan Surat Kematian Yang Anda Buat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
