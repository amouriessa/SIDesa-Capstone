<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kelahiran - Desa Sidorejo</title>

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
                <a href="/kelahiranadmin" class="text-sm font-bold text-white hover:underline">Permohonan Surat Kelahiran</a>
                <a href="/" class="text-sm font-bold text-white hover:underline">Pencatatan Surat Kelahiran</a>
            </nav>
        </div>
    </header>

    <main class="container px-6 py-20 mx-auto">
        <div class="items-center">
            <h2 class="mb-8 text-2xl font-bold text-center">Tambah Formulir Surat Kelahiran</h2>

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

                <form action="{{ route('kelahiranadmin.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Nomor Surat -->
                        <div class="mb-2">
                            <label for="nomor_surat" class="block text-sm font-medium text-gray-700">Nomor Surat</label>
                            <input type="text" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" class="block px-2 py-1 mt-1 border border-gray-300 rounded-lg shadow-sm w-28 focus:ring-mainColor focus:border-mainColor" required>
                        </div>

                        <div>
                            <p class="py-2 text-sm font-medium text-center text-white rounded bg-mainColor">
                                Informasi Bayi
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Nama Anak -->
                            <div class="mb-4">
                                <label for="nama_anak" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" id="nama_anak" name="nama_anak" value="{{ old('nama_anak') }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>

                            <!-- Jenis Kelamin Anak -->
                            <div class="mb-4">
                                <label for="jenis_kelamin_anak" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <div class="px-4 py-2 mt-1 border border-gray-300 rounded-lg">
                                    <div>
                                        <!-- Radio button for Laki-laki -->
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="jenis_kelamin_anak" value="Laki-laki"
                                                {{ old('jenis_kelamin_anak') == 'Laki-laki' ? 'checked' : '' }}
                                                class="w-3 h-3 form-radio text-mainColor focus:ring-mainColor">
                                            <span class="ml-2 text-sm text-gray-700">Laki-laki</span>
                                        </label>

                                        <!-- Radio button for Perempuan -->
                                        <label class="inline-flex items-center ml-6">
                                            <input type="radio" name="jenis_kelamin_anak" value="Perempuan"
                                                {{ old('jenis_kelamin_anak') == 'Perempuan' ? 'checked' : '' }}
                                                class="w-3 h-3 form-radio text-mainColor focus:ring-mainColor">
                                            <span class="ml-2 text-sm text-gray-700">Perempuan</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Tanggal Lahir -->
                            <div class="mb-4">
                                <label for="tanggal_kelahiran" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="date" id="tanggal_kelahiran" name="tanggal_kelahiran" value="{{ old('tanggal_kelahiran') }}"
                                class="block w-full px-4 py-2 mt-1 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>

                            <script>
                                document.getElementById('tanggal_kelahiran').addEventListener('change', function () {
                                    const tanggal = this.value;
                                    if (tanggal) {
                                        const hari = new Date(tanggal).toLocaleDateString('id-ID', { weekday: 'long' });
                                        document.getElementById('hari_kelahiran').value = hari;
                                    } else {
                                        document.getElementById('hari_kelahiran').value = '';
                                    }
                                });
                            </script>

                            <!-- Hari Kelahiran -->
                            <div class="mb-4">
                                <label for="hari_kelahiran" class="block text-sm font-medium text-gray-700">Hari Kelahiran</label>
                                <input type="text" id="hari_kelahiran" name="hari_kelahiran" value="{{ old('hari_kelahiran') }}"
                                class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor"
                                    readonly required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Tempat Kelahiran -->
                            <div class="mb-4">
                                <label for="tempat_kelahiran" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                <input type="text" id="tempat_kelahiran" name="tempat_kelahiran" value="{{ old('tempat_kelahiran') }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>

                            <!-- Alamat Anak -->
                            <div class="mb-4">
                                <label for="alamat_anak" class="block text-sm font-medium text-gray-700">Alamat Anak</label>
                                <input type="text" name="alamat_anak" rows="3" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>{{ old('alamat_anak') }}</textarea>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Urutan Anak -->
                            <div class="mb-4">
                                <label for="urutan_anak" class="block text-sm font-medium text-gray-700">Urutan Anak Ke-</label>
                                <input type="text" id="urutan_anak" name="urutan_anak" value="{{ old('urutan_anak') }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>

                            <!-- Total Saudara -->
                            <div class="mb-4">
                                <label for="total_saudara" class="block text-sm font-medium text-gray-700">Total Saudara</label>
                                <input type="text" id="total_saudara" name="total_saudara" value="{{ old('total_saudara') }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>
                        </div>

                        <div>
                            <p class="py-2 text-sm font-medium text-center text-white rounded bg-mainColor">
                                Informasi Orangtua
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Nama Ayah -->
                            <div class="mb-4">
                                <label for="nama_ayah" class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                                <input type="text" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>

                            <!-- Alamat Ayah -->
                            <div class="mb-4">
                                <label for="alamat_ayah" class="block text-sm font-medium text-gray-700">Alamat Ayah</label>
                                <input type="text" id="alamat_ayah" name="alamat_ayah" value="{{ old('alamat_ayah') }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Nama Ibu -->
                            <div class="mb-4">
                                <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                                <input type="text" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>

                            <!-- Alamat Ibu -->
                            <div class="mb-4">
                                <label for="alamat_ibu" class="block text-sm font-medium text-gray-700">Alamat Ibu</label>
                                <input type="text" id="alamat_ibu" name="alamat_ibu" value="{{ old('alamat_ibu') }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="flex items-center justify-end mt-6 space-x-4">
                            <button type="submit" class="px-6 py-2 text-sm font-bold text-white rounded-lg shadow-md bg-mainColor hover:bg-mainColorHover focus:outline-none">Simpan</button>
                            <a href="{{ route('kelahiranadmin.index') }}" class="px-6 py-2 text-sm font-bold text-black bg-gray-300 rounded-lg shadow-md hover:bg-gray-400 focus:outline-none">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
