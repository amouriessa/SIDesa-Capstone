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
    <!-- Header -->
    <header class="sticky top-0 z-50 text-white shadow-lg bg-mainColor">
        <div class="container flex items-center justify-between px-4 py-3 mx-auto">
            <div class="flex items-center shrink-0">
                <h1 class="text-xl font-semibold">SIDOREJO</h1>
            </div>
            <nav class="ml-auto">
                <ul class="flex space-x-4">
                    <li><a href="#website" class="px-3 py-2 text-sm font-normal rounded-md hover:text-gray-200">Tentang Website</a></li>
                    <li><a href="#layanan" class="px-3 py-2 text-sm font-normal rounded-md hover:text-gray-200">Tentang Layanan</a></li>
                </ul>
            </nav>
            <div class="relative">
                <!-- Button Login -->
                <button
                    id="loginButton"
                    class="py-1 ml-8 text-sm font-bold bg-white rounded-lg shadow-md px-7 text-mainColor hover:bg-gray-200 focus:outline-none"
                    onclick="toggleDropdown()">
                    LOGIN
                </button>

                <!-- Dropdown Menu -->
                <div
                    id="loginDropdown"
                    class="absolute right-0 hidden w-40 mt-2 bg-white rounded-lg shadow-lg">
                    <a href="{{ route('login.admin') }}?role=admin" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login Admin</a>
                    <a href="{{ route('login.penduduk') }}?role=penduduk" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login Penduduk</a>
                </div>
            </div>

            <script>
                // Function to toggle dropdown visibility
                function toggleDropdown() {
                    const dropdown = document.getElementById('loginDropdown');
                    dropdown.classList.toggle('hidden');
                }

                // Close dropdown when clicking outside
                window.addEventListener('click', function (e) {
                    const button = document.getElementById('loginButton');
                    const dropdown = document.getElementById('loginDropdown');
                    if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            </script>
        </div>
    </header>

    <!-- Gambar di Bawah Navbar -->
    <section class="mb-32">
        <div class="relative">
            <img src="images/landingpage/sidorejoheader.png" alt="Kalurahan Sidorejo" class="object-cover w-full h-70">
        </div>
    </section>

    <!-- Main Content -->
    <main id="website" class="container px-6 py-20 mx-auto">
        <div class="items-center">
            <!-- Description -->
            <h2 class="mb-8 text-2xl font-bold text-center">Tentang Website</h2>
            @foreach($data_persyaratan1 as $persyaratan)
                <p class="text-center">{{ $persyaratan->tentang_website }}</p>
                {{-- <p class="mb-4 text-center text-gray-700">
                    Selamat datang di website pelayanan publik desa Sidorejo. Website ini merupakan digitalisasi
                    sistem pelayanan permohonan surat kelahiran dan surat kematian di Kalurahan Sidorejo. Website
                    ini merupakan solusi praktis untuk kebutuhan pembuatan surat permohonan. Yakni, proses pengajuan
                    bisa dilakukan dengan mudah dari mana saja, kapan saja, tanpa perlu datang dan antre di kantor.
                </p> --}}
            @endforeach
            <img src="images/landingpage/kalurahan.png" alt="Kalurahan Sidorejo" class="object-cover mx-auto mt-10 w-96 h-70">
        </div>
    </main>

    <main id="layanan" class="container px-6 py-32 mx-auto mb-20">
        <div class="items-center">
            <!-- Description -->
            <h2 class="mb-8 text-2xl font-bold text-center">Tentang Layanan</h2>

            <div class="grid items-center grid-cols-1 gap-6 justify-items-center md:grid-cols-2">
                <div class="justify-center p-4 mx-auto transition-shadow duration-300 bg-white rounded-lg shadow-md h-72 w-72 hover:shadow-lg">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 mb-8">
                            <a>
                                <img src="images/landingpage/birth.png" alt="Kelahiran" class="w-full h-full mr-2">
                            </a>
                        </div>
                        <h3 class="mb-5 text-sm font-medium text-textlp">Surat Permohonan Kelahiran</h3>
                        <button onclick="openModal('modalKelahiran')" class="py-1 text-xs font-bold text-white rounded-md shadow-md bg-mainColor px-7 hover:bg-darkerColor focus:outline-none">
                            Selengkapnya
                        </button>
                    </div>
                </div>

                <div class="p-4 mx-auto transition-shadow duration-300 bg-white rounded-lg shadow-md w-72 h-72 hover:shadow-lg">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 mb-8">
                            <a>
                                <img src="images/landingpage/tombstone.png" alt="Kematian" class="w-full h-full mr-2">
                            </a>
                        </div>
                        <h3 class="mb-5 text-sm font-medium text-textlp">Surat Permohonan Kematian</h3>
                        <button onclick="openModal('modalKematian')" class="py-1 text-xs font-bold text-white rounded-md shadow-md bg-mainColor px-7 hover:bg-darkerColor focus:outline-none">
                            Selengkapnya
                        </button>
                    </div>
                </div>

                <!-- Modal Kelahiran -->
                <div id="modalKelahiran" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
                    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg max-h-[70vh] overflow-y-auto">
                        <h2 class="mb-4 text-xl font-bold text-center">Persyaratan Permohonan Surat Kelahiran</h2>
                        <div>
                            @foreach($data_persyaratan1 as $persyaratan)
                                <div class="mb-4">
                                    <p>{{ $persyaratan->persyaratan_kelahiran }}</p>

                                    {{-- <ol class="list-decimal list-inside">
                                        <li class="mb-2 text-sm font-normal">Penduduk diwajibkan Login menggunakan akun yang telah diregistrasi terlebih dahulu</li>
                                        <li class="mb-2 text-sm font-normal">Jika penduduk belum memiliki akun, penduduk wajib melakukan registrasi akun</li>
                                        <li class="mb-2 text-sm font-normal">Setelah login penduduk dapat melakukan permohonan dengan mengisi formulir yang disediakan</li>
                                        <li class="mb-2 text-sm font-normal">Mohon persiapkan persyaratan berikut sebelum mengajukan surat:</li>
                                        <ol class="ml-8 list-decimal">
                                            <li class="mb-2 text-sm font-normal">Kartu Keluarga</li>
                                            <li class="mb-2 text-sm font-normal">Akta Kelahiran</li>
                                        </ol>
                                    </ol> --}}
                                </div>
                            @endforeach
                            <a href="{{ route('kelahiranpenduduk.create') }}">
                                <button type="submit" class="w-full px-4 py-2 text-base font-medium text-white rounded bg-mainColor hover:bg-darkerColor">
                                    Buat Permohonan
                                </button>
                            </a>

                        </div>
                        <button onclick="closeModal('modalKelahiran')" class="w-full px-4 py-2 mt-4 text-white bg-gray-600 rounded hover:bg-gray-700">
                            Tutup
                        </button>
                    </div>
                </div>

                <!-- Modal Kematian -->
                <div id="modalKematian" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
                    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg max-h-[70vh] overflow-y-auto">
                        <h2 class="mb-4 text-xl font-bold text-center">Persyaratan Permohonan Surat Kematian</h2>
                        <div>
                            @foreach($data_persyaratan1 as $persyaratan)
                                <div class="mb-4">
                                    <p>{{ $persyaratan->persyaratan_kematian }}</p>
                                    {{-- <ol class="list-decimal list-inside">
                                        <li class="mb-2 text-sm font-normal">Penduduk diwajibkan Login menggunakan akun yang telah diregistrasi terlebih dahulu</li>
                                        <li class="mb-2 text-sm font-normal">Jika penduduk belum memiliki akun, penduduk wajib melakukan registrasi akun</li>
                                        <li class="mb-2 text-sm font-normal">Setelah login penduduk dapat melakukan permohonan dengan mengisi formulir yang disediakan</li>
                                        <li class="mb-2 text-sm font-normal">Mohon persiapkan persyaratan berikut sebelum mengajukan surat:</li>
                                        <ol class="ml-8 list-decimal">
                                            <li class="mb-2 text-sm font-normal">Kartu Keluarga</li>
                                            <li class="mb-2 text-sm font-normal">KTP</li>
                                        </ol>
                                    </ol> --}}
                                </div>
                            @endforeach
                            <a href="{{ route('kematianpenduduk.create') }}">
                                <button type="submit" class="w-full px-4 py-2 text-base font-medium text-white rounded bg-mainColor hover:bg-darkerColor">
                                    Buat Permohonan
                                </button>
                            </a>
                        </div>
                        <button onclick="closeModal('modalKematian')" class="w-full px-4 py-2 mt-4 text-white bg-gray-600 rounded hover:bg-gray-700">
                            Tutup
                        </button>
                    </div>
                </div>

                <script>
                    function openModal(modalId) {
                        document.getElementById(modalId).classList.remove('hidden');
                    }

                    function closeModal(modalId) {
                        document.getElementById(modalId).classList.add('hidden');
                    }
                </script>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-white bg-mainColor">
        <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Grid Container -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
                <!-- Kolom 1: Informasi Desa -->
                <div>
                    <h3 class="mb-4 text-lg font-semibold">Desa Sidorejo</h3>
                    <div class="flex items-start mb-2 space-x-2">
                        <svg class="w-5 h-5 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="text-sm">Jl. Balai Desa, Ledok, Sidorejo<br/>Kec. Lendah, Kab. Kulon Progo<br/>55663</p>
                    </div>
                    <div class="flex items-center mb-2 space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-sm">(021) 1234567</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                          </svg>
                        <a href="https://sidorejo-kulonprogo.desa.id/" class="text-sm underline">Website Utama</a>
                    </div>
                </div>

                <!-- Kolom 2: Mini Maps -->
                <div>
                    <h3 class="mb-4 text-lg font-semibold">Lokasi Kami</h3>
                    <div class="w-full h-48 overflow-hidden rounded-lg">
                        <iframe
                            class="border-0 h-30 w-30"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15812.661364338895!2d110.15000000000002!3d-7.916666699999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7ae9b437ee2049%3A0x5027a76e356d760!2sSidorejo%2C%20Lendah%2C%20Kulon%20Progo%20Regency%2C%20Special%20Region%20of%20Yogyakarta!5e0!3m2!1sen!2sid!4v1624451234567!5m2!1sen!2sid"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Kolom 2: Layanan Publik -->
                <div>
                    <h3 class="mb-4 text-lg font-semibold">Layanan Publik</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('kelahiranpenduduk.create') }}" class="text-sm transition hover:text-green-200">Surat Keterangan Kelahiran</a>
                        </li>
                        <li>
                            <a href="{{ route('kematianpenduduk.create') }}" class="text-sm transition hover:text-green-200">Surat Keterangan Kematian</a>
                        </li>
                    </ul>
                </div>

                <!-- Kolom 3: Jam Pelayanan -->
                <div>
                    <h3 class="mb-4 text-lg font-semibold">Jam Pelayanan</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span>Senin - Sabtu</span>
                            <span>08:00 - 14:00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Minggu</span>
                            <span>Tutup</span>
                        </div>
                    </div>

                    <!-- Media Sosial -->
                    <div class="mt-6">
                        <h4 class="mb-3 text-sm font-semibold">Ikuti Kami</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="transition hover:text-green-200">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="transition hover:text-green-200">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="transition hover:text-green-200">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                            </a>
                            <a href="#" class="transition hover:text-green-200">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="pt-8 mt-8 border-t border-green-700">
                <p class="text-sm text-center">
                    © {{ date('Y') }} Desa Sidorejo. Hak Cipta Dilindungi.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
