<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Data Kelahiran - Desa Sidorejo</title>

        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <link rel="icon" type="image/png" href="{{ asset('images/landingpage/logo2.png') }}">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Tailwind CSS auto-generated styles here */
            </style>
        @endif

        <script>
            function updateHariLahir(event) {
                const inputTanggal = event.target.value;
                if (inputTanggal) {
                    const date = new Date(inputTanggal);
                    const options = { weekday: 'long' };
                    const hariLahir = new Intl.DateTimeFormat('id-ID', options).format(date);
                    document.getElementById('hari_kelahiran').value = hariLahir;
                } else {
                    document.getElementById('hari_kelahiran').value = '';
                }
            }

            function setHariLahir() {
                const hariLahir = document.getElementById('hari_kelahiran').value;
                document.getElementById('hidden_hari_kelahiran').value = hariLahir;
            }
        </script>
    </head>
    <body class="antialiased bg-gray-100">
        <header class="sticky top-0 z-50 text-white shadow-lg bg-mainColor">
            <div class="container flex items-center justify-between px-4 py-3 mx-auto">
                <!-- Navigation Menu -->
                <nav class="hidden space-x-6 sm:flex sm:items-center">
                    <a href="/kelahiranpenduduk" class="text-sm font-bold text-white hover:underline">Permohonan Surat Kelahiran</a>
                    <a href="/" class="text-sm font-bold text-white hover:underline">Detail Formulir Surat Kelahiran</a>
                </nav>
            </div>
        </header>


        <main class="container px-6 py-20 mx-auto">
            <div class="items-center">
                <h2 class="mb-8 text-2xl font-bold text-center">Detail Formulir Surat Kelahiran</h2>
            </div>

            {{-- Edit Form --}}
            <div class="max-w-2xl p-6 mx-auto mb-8 bg-white border border-gray-200 rounded-lg shadow-sm drop-shadow">

                <div class="space-y-3">

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Nomor Surat -->
                        <div>
                            <label for="nomor_surat" class="block text-sm font-medium text-gray-700">Nomor Surat</label>
                            <input type="text" name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat', $birth->nomor_surat) }}" class="block px-2 py-1 mt-1 border border-gray-300 rounded-lg shadow-sm w-28 focus:ring-mainColor focus:border-mainColor" readonly>
                        </div>

                        <div>
                            <p class="py-2 text-sm font-medium text-center text-white rounded bg-mainColor">
                                Informasi Bayi
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Nama Anak -->
                            <div>
                                <label for="nama_anak" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" name="nama_anak" id="nama_anak" value="{{ old('nama_anak', $birth->nama_anak) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" readonly>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label for="jenis_kelamin_anak" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <input name="jenis_kelamin_anak" id="jenis_kelamin_anak" value="{{ old('jenis_kelamin_anak', $birth->jenis_kelamin_anak) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" readonly>
                                </input>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Tanggal Lahir -->
                            <div>
                                <label for="tanggal_kelahiran" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="text" name="tanggal_kelahiran" id="tanggal_kelahiran" value="{{ old('tanggal_kelahiran', \Carbon\Carbon::parse($birth->tanggal_kelahiran)->format('d-m-Y')) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" readonly>
                            </div>

                            <!-- Hari Kelahiran -->
                            <div>
                                <label for="hari_kelahiran" class="block text-sm font-medium text-gray-700">Hari Lahir</label>
                                <input type="text" id="hari_kelahiran" value="{{ old('hari_kelahiran', $birth->hari_kelahiran) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" readonly>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Tempat Kelahiran -->
                            <div>
                                <label for="tempat_kelahiran" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                <input type="text" name="tempat_kelahiran" id="tempat_kelahiran" value="{{ old('tempat_kelahiran', $birth->tempat_kelahiran) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" readonly>
                            </div>

                            <!-- Alamat Anak -->
                            <div>
                                <label for="alamat_anak" class="block text-sm font-medium text-gray-700">Alamat Anak</label>
                                <input type="text" name="alamat_anak" id="alamat_anak" value="{{ old('alamat_anak', $birth->alamat_anak) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" readonly>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Urutan Anak -->
                            <div>
                                <label for="urutan_anak" class="block text-sm font-medium text-gray-700">Urutan Anak Ke-</label>
                                <input type="text" name="urutan_anak" id="urutan_anak" value="{{ old('urutan_anak', $birth->urutan_anak) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" readonly>

                            </div>

                            <!-- Total Saudara -->
                            <div>
                                <label for="total_saudara" class="block text-sm font-medium text-gray-700">Total Saudara</label>
                                <input type="text" name="total_saudara" id="total_saudara" value="{{ old('total_saudara', $birth->total_saudara) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" readonly>

                            </div>
                        </div>

                        <div>
                            <p class="py-2 text-sm font-medium text-center text-white rounded bg-mainColor">
                                Informasi Orangtua
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Nama Ayah -->
                            <div>
                                <label for="nama_ayah" class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                                <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah', $birth->nama_ayah) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" readonly>

                            </div>

                            <!-- Alamat Ayah -->
                            <div>
                                <label for="alamat_ayah" class="block text-sm font-medium text-gray-700">Alamat Ayah</label>
                                <input type="text" name="alamat_ayah" id="alamat_ayah" value="{{ old('alamat_ayah', $birth->alamat_ayah) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" readonly>

                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Nama Ibu -->
                            <div>
                                <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu', $birth->nama_ibu) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" readonly>

                            </div>

                            <!-- Alamat Ibu -->
                            <div>
                                <label for="alamat_ibu" class="block text-sm font-medium text-gray-700">Alamat Ibu</label>
                                <input type="text" name="alamat_ibu" id="alamat_ibu" value="{{ old('alamat_ibu', $birth->alamat_ibu) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" readonly>

                            </div>
                        </div>

                        <div>
                            <p class="py-2 text-sm font-medium text-center text-white rounded bg-mainColor">
                                Foto Persyaratan
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Foto KK -->
                            <div class="mb-4">
                                <label for="foto_kk" class="block text-sm font-medium text-gray-700">Foto KK</label>

                                <!-- Pratinjau Foto KK -->
                                @if (!empty($birth->foto_kk))
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $birth->foto_kk) }}" alt="Foto KK"
                                             class="w-32 h-32 rounded shadow cursor-pointer"
                                             onclick="showModal('{{ asset('storage/' . $birth->foto_kk) }}')">
                                        <p class="mt-2 text-xs text-mainColor">Klik untuk memperbesar</p>
                                    </div>
                                @else
                                    <p class="mt-2 text-xs text-mainColor">Belum ada foto KK yang diunggah.</p>
                                @endif
                            </div>

                            <!-- Foto Akta Kelahiran -->
                            <div class="mb-4">
                                <label for="foto_akta_lahir" class="block text-sm font-medium text-gray-700">Foto Akta Kelahiran</label>

                                <!-- Pratinjau Foto Akta Lahir -->
                                @if (!empty($birth->foto_akta_lahir))
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $birth->foto_akta_lahir) }}" alt="Foto Akta Lahir"
                                             class="w-32 h-32 rounded shadow cursor-pointer"
                                             onclick="showModal('{{ asset('storage/' . $birth->foto_akta_lahir) }}')">
                                        <p class="mt-2 text-xs text-mainColor">Klik untuk memperbesar</p>
                                    </div>
                                @else
                                    <p class="mt-2 text-xs text-mainColor">Belum ada foto akta kelahiran yang diunggah.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Modal -->
                        <div id="imageModal" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
                            <div class="relative">
                                <img id="modalImage" src="" alt="Foto" class="max-w-full max-h-screen rounded shadow">
                                <button class="absolute p-2 text-black bg-white rounded-full top-2 right-2"
                                        onclick="closeModal()">
                                    ✕
                                </button>
                            </div>
                        </div>

                        <script>
                            // Function to show modal
                            function showModal(imageSrc) {
                                const modal = document.getElementById('imageModal');
                                const modalImage = document.getElementById('modalImage');
                                modalImage.src = imageSrc;
                                modal.classList.remove('hidden');
                            }

                            // Function to close modal
                            function closeModal() {
                                const modal = document.getElementById('imageModal');
                                modal.classList.add('hidden');
                            }
                        </script>
                    </div>

                    <div class="flex items-center justify-end mt-6 space-x-4">
                        {{-- <button type="submit" class="px-6 py-2 text-sm font-bold text-white rounded-lg shadow-md bg-mainColor hover:bg-mainColorHover focus:outline-none">
                            Update Data
                        </button> --}}
                        <a href="{{ route('kelahiranpenduduk.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded hover:bg-gray-300">Tutup</a>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
