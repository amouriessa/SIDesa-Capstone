<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Sidorejo</title>

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/landingpage/logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-poppins bg-gray-50">
    <aside
        x-data="{
            open: true,
            activeRoute: '{{ Request::path() }}',
            isActive(route) {
                return this.activeRoute === route || this.activeRoute.startsWith(route + '/');
            },
            isMenuOpen: false,
            profileOpen: false
        }"
        class="fixed top-0 left-0 z-40 h-screen transition-transform"
        :class="{'w-64': open, 'w-20': !open, '-translate-x-full sm:translate-x-0': !open}"
    >
        <!-- Sidebar Container -->
        <div class="flex flex-col h-full overflow-y-auto bg-white border-r border-gray-200">
            <!-- Logo Section -->
            <div class="flex items-center justify-between px-4 py-5">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/landingpage/logo.png') }}" alt="Logo" class="w-10 h-10">
                    <span x-show="open" class="text-lg font-semibold text-gray-800 transition-opacity duration-200">
                        Desa Sidorejo
                    </span>
                </div>

            </div>



            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-3 space-y-2">
                <!-- Dashboard -->
                <a href="{{ url('/admindashboard') }}"
                   class="flex items-center px-4 py-3 text-gray-700 transition-colors rounded-lg hover:bg-green-100"
                   :class="{'bg-mainColor text-white': isActive('admindashboard')}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span x-show="open" class="ml-3 text-sm font-semibold">Dashboard</span>
                </a>

                <!-- Daftar Permohonan Dropdown -->
                <div x-data="{ isOpen: false }">
                    <button @click="isOpen = !isOpen"
                            class="flex items-center justify-between w-full px-4 py-3 text-gray-700 transition-colors rounded-lg hover:bg-green-100"
                            :class="{'bg-mainColor text-white': isActive('kelahiranadmin') || isActive('kematianadmin')}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span x-show="open" class="ml-3 text-sm font-semibold">Pelayanan Surat</span>
                        </div>
                        <svg x-show="open" class="w-4 h-4 transition-transform" :class="{ 'rotate-180': isOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="isOpen" x-collapse class="pr-4 mt-1 space-y-1 pl-11">
                        <a href="{{ url('/kelahiranadmin') }}"
                           class="block px-4 py-2 text-sm text-gray-700 transition-colors rounded-lg hover:bg-green-100"
                           :class="{'bg-green-50 text-blue-600': isActive('kelahiranadmin')}">
                            Surat Kelahiran
                        </a>
                        <a href="{{ url('/kematianadmin') }}"
                           class="block px-4 py-2 text-sm text-gray-700 transition-colors rounded-lg hover:bg-green-100"
                           :class="{'bg-green-50 text-blue-600': isActive('kematianadmin')}">
                            Surat Kematian
                        </a>
                    </div>
                </div>

                <!-- Data -->
                <a href="{{ url('/datapersyaratan') }}"
                   class="flex items-center px-4 py-3 text-gray-700 transition-colors rounded-lg hover:bg-green-100"
                   :class="{'bg-mainColor text-white': isActive('datapersyaratan')}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                    </svg>
                    <span x-show="open" class="ml-3 text-sm font-semibold">Data Persyaratan</span>
                </a>
            </nav>

            <!-- Profile Section -->
            <div class="px-4 py-3 border-b border-gray-200">
                <div class="relative flex items-center space-x-3">
                    <!-- Profile Picture -->
                    <div class="relative ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                          </svg>
                        <div class="absolute bottom-0 w-3 h-3 ml-3 bg-green-400 border-2 border-white rounded-full"></div>
                    </div>

                    <!-- Profile Info -->
                    <div x-show="open" class="flex-1">
                        <a href="{{ url('/daftaruser') }}" class="flex items-center justify-between w-full group">
                            <div class="text-left">
                                <h3 class="text-sm font-semibold text-gray-800">{{ Auth::user()->nama }}</h3>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Logout Button -->
            <div class="p-4 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-3 text-gray-700 transition-colors rounded-lg hover:bg-red-50 hover:text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span x-show="open" class="ml-3 text-sm font-semibold">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>
</body>
</html>
