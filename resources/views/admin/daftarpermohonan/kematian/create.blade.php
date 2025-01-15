<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kematian - Desa Sidorejo</title>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/landingpage/logo.png') }}">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Include your fallback Tailwind CSS styles here */
        </style>
    @endif
</head>
<body class="antialiased bg-gray-100">
    <header class="sticky top-0 z-50 text-white shadow-lg bg-mainColor">
        <div class="container flex items-center justify-between px-4 py-3 mx-auto">
            <!-- Navigation Menu -->
            <nav class="hidden space-x-6 sm:flex sm:items-center">
                <a href="/kematianadmin" class="text-sm font-bold text-white hover:underline">Permohonan Surat Kematian</a>
                <a href="/" class="text-sm font-bold text-white hover:underline">Pencatatan Surat Kematian</a>
            </nav>
        </div>
    </header>

    <main class="container px-6 py-20 mx-auto">
        <div class="items-center">

            <h2 class="mb-8 text-2xl font-bold text-center">Tambah Formulir Surat Kematian</h2>

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

                <form action="{{ route('kematianadmin.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Nomor Surat -->
                        <div class="mb-2">
                            <label for="nomor_surat_kematian" class="block text-sm font-medium text-gray-700">Nomor Surat</label>
                            <input type="text" id="nomor_surat_kematian" name="nomor_surat_kematian" value="{{ old('nomor_surat_kematian') }}" class="block px-2 py-1 mt-1 border border-gray-300 rounded-lg shadow-sm w-28 focus:ring-mainColor focus:border-mainColor" required>
                        </div>

                        <div>
                            <p class="py-2 text-sm font-medium text-center text-white rounded bg-mainColor">
                                Informasi Almarhum
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Nama Almarhum -->
                            <div class="mb-4">
                                <label for="nama_alm" class="block text-sm font-medium text-gray-700">Nama Almarhum</label>
                                <input type="text" id="nama_alm" name="nama_alm" value="{{ old('nama_alm') }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>

                            <!-- Jenis Kelamin Almarhum -->
                            <div class="mb-4">
                                <label for="jenis_kelamin_alm" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <div class="px-4 py-2 mt-1 border border-gray-300 rounded-lg">
                                    <div>
                                        <!-- Radio button for Laki-laki -->
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="jenis_kelamin_alm" value="Laki-laki"
                                                {{ old('jenis_kelamin_alm') == 'Laki-laki' ? 'checked' : '' }}
                                                class="w-3 h-3 form-radio text-mainColor focus:ring-mainColor">
                                            <span class="ml-2 text-sm text-gray-700">Laki-laki</span>
                                        </label>

                                        <!-- Radio button for Perempuan -->
                                        <label class="inline-flex items-center ml-6">
                                            <input type="radio" name="jenis_kelamin_alm" value="Perempuan"
                                                {{ old('jenis_kelamin_alm') == 'Perempuan' ? 'checked' : '' }}
                                                class="w-3 h-3 form-radio text-mainColor focus:ring-mainColor">
                                            <span class="ml-2 text-sm text-gray-700">Perempuan</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Umur Almarhum -->
                            <div class="mb-4">
                                <label for="umur_almarhum" class="block text-sm font-medium text-gray-700">Umur Almarhum</label>
                                <input type="text" id="umur_almarhum" name="umur_almarhum" value="{{ old('umur_almarhum') }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>

                            <!-- Alamat Alm -->
                            <div class="mb-4">
                                <label for="alamat_alm" class="block text-sm font-medium text-gray-700">Alamat Almarhum</label>
                                <input type="text" name="alamat_alm" rows="3" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>{{ old('alamat_alm') }}</input>
                            </div>
                        </div>

                        <div>
                            <p class="py-2 text-sm font-medium text-center text-white rounded bg-mainColor">
                                Informasi Kematian
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Tempat Kematian -->
                            <div class="mb-4">
                                <label for="tempat_kematian" class="block text-sm font-medium text-gray-700">Tempat Kematian</label>
                                <input type="text" id="tempat_kematian" name="tempat_kematian" value="{{ old('tempat_kematian') }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>

                            <!-- Penyebab Kematian -->
                            <div class="mb-4">
                                <label for="penyebab_kematian" class="block text-sm font-medium text-gray-700">Penyebab Kematian</label>
                                <input type="text" id="penyebab_kematian" name="penyebab_kematian" value="{{ old('penyebab_kematian') }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Tanggal Kematian Almarhum -->
                            <div class="mb-4">
                                <label for="tanggal_kematian" class="block text-sm font-medium text-gray-700">Tanggal Kematian Almarhum</label>
                                <input type="date" id="tanggal_kematian" name="tanggal_kematian" value="{{ old('tanggal_kematian') }}"
                                class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>

                            <script>
                                document.getElementById('tanggal_kematian').addEventListener('change', function () {
                                    const tanggal = this.value;
                                    if (tanggal) {
                                        const hari = new Date(tanggal).toLocaleDateString('id-ID', { weekday: 'long' });
                                        document.getElementById('hari_kematian').value = hari;
                                    } else {
                                        document.getElementById('hari_kematian').value = '';
                                    }
                                });
                            </script>

                            <!-- Hari Kematian -->
                            <div class="mb-4">
                                <label for="hari_kematian" class="block text-sm font-medium text-gray-700">Hari Kematian</label>
                                <input type="text" id="hari_kematian" name="hari_kematian" value="{{ old('hari_kematian') }}"
                                class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" readonly required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Pukul Kematian -->
                            <div class="mb-4">
                                <label for="pukul_kematian" class="block text-sm font-medium text-gray-700">Pukul Kematian</label>
                                <input type="time" id="pukul_kematian" name="pukul_kematian" value="{{ old('pukul_kematian') }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="flex items-center justify-end mt-6 space-x-4">
                            <button type="submit" class="px-6 py-2 text-sm font-bold text-white rounded-lg shadow-md bg-mainColor hover:bg-mainColorHover focus:outline-none">Simpan</button>
                            <a href="{{ route('kematianadmin.index') }}" class="px-6 py-2 text-sm font-bold text-black bg-gray-300 rounded-lg shadow-md hover:bg-gray-400 focus:outline-none">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
