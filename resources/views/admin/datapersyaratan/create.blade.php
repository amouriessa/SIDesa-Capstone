<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Persyaratan - Desa Sidorejo</title>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"></script> --}}

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/landingpage/logo.png') }}">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Include your fallback Tailwind CSS styles here */

            /* .tox-tinymce {
                z-index: 1000;
            } */
        </style>
    @endif

    {{-- <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'lists bold italic',
            toolbar: 'bold italic | numlist bullist',
            menubar: false
        });
    </script> --}}
</head>
<body class="antialiased bg-gray-100">
    <header class="sticky top-0 z-50 text-white shadow-lg bg-mainColor">
        <div class="container flex items-center justify-between px-4 py-3 mx-auto">
            <!-- Navigation Menu -->
            <nav class="hidden space-x-6 sm:flex sm:items-center">
                <a href="/kelahiranpenduduk" class="text-sm font-bold text-white hover:underline">Data Persyaratan</a>
                <a href="/" class="text-sm font-bold text-white hover:underline">Tambah Data Persyaratan</a>
            </nav>
        </div>
    </header>

    <main class="container px-6 py-20 mx-auto">
        <div class="items-center">
            <h2 class="mb-8 text-2xl font-bold text-center">Tambah Data Persyaratan</h2>

            <div class="max-w-2xl p-6 mx-auto mb-8 bg-white border border-gray-200 rounded-lg shadow-sm drop-shadow">
                <!-- Alert Error -->
                @if ($errors->any())
                    <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                        <strong>Terjadi Kesalahan:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Alert Success -->
                @if (session('success'))
                    <div class="p-4 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('datapersyaratan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="tentang_website" class="block text-sm font-medium text-gray-700">Tentang Website</label>
                        <textarea name="tentang_website" id="tentang_website" rows="4" class="w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="persyaratan_kelahiran" class="block text-sm font-medium text-gray-700">Persyaratan Kelahiran</label>
                        <textarea name="persyaratan_kelahiran" id="persyaratan_kelahiran" rows="4" class="w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="persyaratan_kematian" class="block text-sm font-medium text-gray-700">Persyaratan Kematian</label>
                        <textarea name="persyaratan_kematian" id="persyaratan_kematian" rows="4" class="w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" ></textarea>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="submit" class="px-4 py-2 text-sm font-semibold text-white rounded-lg bg-mainColor hover:bg-darkerColor">Simpan</button>
                        <a href="{{ route('datapersyaratan.index') }}" class="px-4 py-2 text-sm font-semibold text-white bg-gray-500 rounded-lg hover:bg-gray-600">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
