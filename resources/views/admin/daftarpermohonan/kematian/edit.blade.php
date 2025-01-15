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
            function updateHariMati(event) {
                const inputTanggal = event.target.value;
                if (inputTanggal) {
                    const date = new Date(inputTanggal);
                    const options = { weekday: 'long' };
                    const hariMati = new Intl.DateTimeFormat('id-ID', options).format(date);
                    document.getElementById('hari_kematian').value = hariMati;
                } else {
                    document.getElementById('hari_kematian').value = '';
                }
            }

            function setHariMati() {
                const hariMati = document.getElementById('hari_kematian').value;
                document.getElementById('hidden_hari_kematian').value = hariMati;
            }
        </script>
    </head>
    <body class="antialiased bg-gray-100">
        <header class="sticky top-0 z-50 text-white shadow-lg bg-mainColor">
            <div class="container flex items-center justify-between px-4 py-3 mx-auto">
                <!-- Navigation Menu -->
                <nav class="hidden space-x-6 sm:flex sm:items-center">
                    <a href="/kematianadmin" class="text-sm font-bold text-white hover:underline">Permohonan Surat Kematian</a>
                    <a href="/" class="text-sm font-bold text-white hover:underline">Edit Surat Kematian</a>
                </nav>
            </div>
        </header>


        <main class="container px-6 py-20 mx-auto">
            <div class="items-center">
                <h2 class="mb-8 text-2xl font-bold text-center">Edit Formulir Surat Kematian</h2>
            </div>

            {{-- Edit Form --}}
            <div class="max-w-2xl p-6 mx-auto mb-8 bg-white border border-gray-200 rounded-lg shadow-sm drop-shadow">

                <form id="editKematianForm" action="{{ route('kematianadmin.update', $death->id) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="hari_kematian" id="hidden_hari_kematian" value="{{ old('hari_kematian', $death->hari_kematian) }}">

                    <!-- Grid Layout untuk Form Fields -->
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Nomor Surat -->
                        <div>
                            <label for="nomor_surat_kematian" class="block text-sm font-medium text-gray-700">Nomor Surat</label>
                            <input type="text" name="nomor_surat_kematian" id="nomor_surat_kematian" value="{{ old('nomor_surat_kematian', $death->nomor_surat_kematian) }}" class="block px-2 py-1 mt-1 border border-gray-300 rounded-lg shadow-sm w-28 focus:ring-mainColor focus:border-mainColor">
                            @error('nomor_surat_kematian')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <p class="py-2 text-sm font-medium text-center text-white rounded bg-mainColor">
                                Informasi Almarhum
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Nama Almarhum -->
                            <div>
                                <label for="nama_alm" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" name="nama_alm" id="nama_alm" value="{{ old('nama_alm', $death->nama_alm) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('nama_alm')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label for="jenis_kelamin_alm" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <input type="text" name="jenis_kelamin_alm" id="jenis_kelamin_alm" value="{{ old('jenis_kelamin_alm', $death->jenis_kelamin_alm) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                </input>
                                @error('jenis_kelamin_alm')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Umur Almarhum -->
                            <div>
                                <label for="umur_almarhum" class="block text-sm font-medium text-gray-700">Umur</label>
                                <input type="text" name="umur_almarhum" id="umur_almarhum" value="{{ old('umur_almarhum', $death->umur_almarhum) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('umur_almarhum')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Alamat Alm -->
                            <div>
                                <label for="alamat_alm" class="block text-sm font-medium text-gray-700">Alamat Almarhum</label>
                                <input type="text" name="alamat_alm" id="alamat_alm" value="{{ old('alamat_alm', $death->alamat_alm) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('alamat_alm')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <p class="py-2 text-sm font-medium text-center text-white rounded bg-mainColor">
                                Informasi Kematian
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Tempat Kematian -->
                            <div>
                                <label for="tempat_kematian" class="block text-sm font-medium text-gray-700">Tempat Kematian</label>
                                <input type="text" name="tempat_kematian" id="tempat_kematian" value="{{ old('tempat_kematian', $death->tempat_kematian) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('tempat_kematian')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Penyebab Kematian -->
                            <div>
                                <label for="penyebab_kematian" class="block text-sm font-medium text-gray-700">Penyebab Kematian</label>
                                <input type="text" name="penyebab_kematian" id="penyebab_kematian" value="{{ old('penyebab_kematian', $death->penyebab_kematian) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('penyebab_kematian')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Tanggal Kematian -->
                            <div>
                                <label for="tanggal_kematian" class="block text-sm font-medium text-gray-700">Tanggal Kematian</label>
                                <input type="text" name="tanggal_kematian" id="tanggal_kematian"
                                    value="{{ old('tanggal_kematian', \Carbon\Carbon::parse($death->tanggal_kematian)->format('d-m-Y')) }}"
                                    class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('tanggal_kematian')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Hari Kelahiran -->
                            <div>
                                <label for="hari_kematian" class="block text-sm font-medium text-gray-700">Hari Kematian</label>
                                <input type="text" id="hari_kematian"
                                    value="{{ old('hari_kematian', $death->hari_kematian) }}"
                                    class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor"
                                    readonly>
                                @error('hari_kematian')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Pukul Kematian -->
                            <div>
                                <label for="pukul_kematian" class="block text-sm font-medium text-gray-700">Pukul Kematian</label>
                                <input type="time" name="pukul_kematian" id="pukul_kematian" value="{{ old('pukul_kematian', $death->pukul_kematian) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('pukul_kematian')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div x-data="{ showModal: false, modalImage: '' }">
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Foto KK -->
                                <div class="mb-4">
                                    <label for="foto_kk" class="block text-sm font-medium text-gray-700">Foto KK</label>
                                    @if ($death->foto_kk)
                                        <div class="mb-2">
                                            <img
                                                src="{{ asset('storage/' . $death->foto_kk) }}"
                                                alt="Foto KK"
                                                class="w-32 h-32 rounded shadow cursor-pointer"
                                                @click="modalImage = '{{ asset('storage/' . $death->foto_kk) }}'; showModal = true">
                                            <p class="mt-2 text-xs text-mainColor">Klik gambar untuk memperbesar</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Foto KTP -->
                                <div class="mb-4">
                                    <label for="foto_ktp" class="block text-sm font-medium text-gray-700">Foto KTP</label>
                                    @if ($death->foto_ktp)
                                        <div class="mb-2">
                                            <img
                                                src="{{ asset('storage/' . $death->foto_ktp) }}"
                                                alt="Foto KTP"
                                                class="w-32 h-32 rounded shadow cursor-pointer"
                                                @click="modalImage = '{{ asset('storage/' . $death->foto_ktp) }}'; showModal = true">
                                            <p class="mt-2 text-xs text-mainColor">Klik gambar untuk memperbesar</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Modal untuk memperbesar gambar -->
                            <div
                                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
                                x-show="showModal"
                                x-cloak>
                                <div class="relative max-w-3xl p-4 rounded-lg">
                                    <button
                                        class="absolute p-2 text-xl text-gray-600 bg-white rounded-full top-2 right-2 hover:text-gray-900"
                                        @click.prevent="showModal = false">&times;</button>
                                    <img :src="modalImage" alt="Preview" class="max-w-full max-h-screen rounded-lg">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <div class="w-full">
                                    <label for="status_data" class="block mb-2 text-sm font-medium text-gray-700">
                                        Status Data
                                    </label>
                                    <div class="relative">
                                        <select
                                            id="status_data"
                                            name="status_data"
                                            class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                            <option value="" hidden>Status Data</option>
                                            <option value="Disetujui" {{ $death->status_data === 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                            <option value="Ditolak" {{ $death->status_data === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alasan Gagal (appears only if status is Ditolak) -->
                        <div id="alasan_gagal_container" class="hidden mb-4">
                            <label for="alasan_gagal" class="block text-sm font-medium text-gray-700">Alasan Penolakan</label>
                            <textarea
                                id="alasan_gagal"
                                name="alasan_gagal"
                                class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor"
                                rows="3"
                                placeholder="Masukkan alasan penolakan...">{{ $death->alasan_gagal }}</textarea>
                        </div>
                    </div>

                    <script>
                        // Show/Hide alasan_gagal input based on the selected status
                        document.getElementById('status_data').addEventListener('change', function() {
                            const alasanGagalContainer = document.getElementById('alasan_gagal_container');
                            if (this.value === 'Ditolak') {
                                alasanGagalContainer.classList.remove('hidden');
                            } else {
                                alasanGagalContainer.classList.add('hidden');
                            }
                        });
                    </script>

                    <div class="flex items-center justify-end mt-6 space-x-4">
                        <button type="submit" class="px-6 py-2 text-sm font-semibold text-white rounded-lg shadow-md bg-mainColor hover:bg-mainColorHover focus:outline-none">
                            Update Data
                        </button>
                        <a href="{{ route('kematianadmin.index') }}" class="px-6 py-2 text-sm font-semibold text-black bg-gray-300 rounded-lg shadow-md hover:bg-gray-400 focus:outline-none">Tutup</a>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>