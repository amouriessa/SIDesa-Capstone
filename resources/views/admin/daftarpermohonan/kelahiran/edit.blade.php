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
            function confirmVerify(itemId) {
                const confirmation = confirm("Apakah Anda yakin ingin menyetujui surat ini?");
                if (confirmation) {
                    document.getElementById('verify-form-' + itemId).submit();
                }
            }
        </script>

        <script>
            function confirmCancelVerify(itemId) {
                const confirmation = confirm("Apakah Anda yakin ingin menolak surat ini?");
                if (confirmation) {
                    document.getElementById('cancel-verify-form-' + itemId).submit();
                }
            }
        </script>
    </head>
    <body class="antialiased bg-gray-100">
        <header class="sticky top-0 z-50 text-white shadow-lg bg-mainColor">
            <div class="container flex items-center justify-between px-4 py-3 mx-auto">
                <!-- Navigation Menu -->
                <nav class="hidden space-x-6 sm:flex sm:items-center">
                    <a href="/kelahiranadmin" class="text-sm font-bold text-white hover:underline">Permohonan Surat Kelahiran</a>
                    <a href="/" class="text-sm font-bold text-white hover:underline">Edit Surat Kelahiran</a>
                </nav>
            </div>
        </header>


        <main class="container px-6 py-20 mx-auto">
            <div class="items-center">
                <h2 class="mb-8 text-2xl font-bold text-center">Edit Formulir Surat Kelahiran</h2>
            </div>

            {{-- Edit Form --}}
            <div class="max-w-2xl p-6 mx-auto mb-8 bg-white border border-gray-200 rounded-lg shadow-sm drop-shadow">

                <form id="editKelahiranForm" action="{{ route('kelahiranadmin.update', $birth->id) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="hari_kelahiran" id="hidden_hari_kelahiran" value="{{ old('hari_kelahiran', $birth->hari_kelahiran) }}">

                    <!-- Grid Layout untuk Form Fields -->
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Nomor Surat -->
                        <div>
                            <label for="nomor_surat" class="block text-sm font-medium text-gray-700">Nomor Surat</label>
                            <input type="text" name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat', $birth->nomor_surat) }}" class="block px-2 py-1 mt-1 border border-gray-300 rounded-lg shadow-sm w-28 focus:ring-mainColor focus:border-mainColor">
                            @error('nomor_surat')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
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
                                <input type="text" name="nama_anak" id="nama_anak" value="{{ old('nama_anak', $birth->nama_anak) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('nama_anak')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label for="jenis_kelamin_anak" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <input type="text" name="jenis_kelamin_anak" id="jenis_kelamin_anak" value="{{ old('jenis_kelamin_anak', $birth->jenis_kelamin_anak) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                </input>
                                @error('jenis_kelamin_anak')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Tanggal Lahir -->
                            <div>
                                <label for="tanggal_kelahiran" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="text" name="tanggal_kelahiran" id="tanggal_kelahiran"
                                    value="{{ old('tanggal_kelahiran', \Carbon\Carbon::parse($birth->tanggal_kelahiran)->format('d-m-Y')) }}"
                                    class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('tanggal_kelahiran')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Hari Kelahiran -->
                            <div>
                                <label for="hari_kelahiran" class="block text-sm font-medium text-gray-700">Hari Lahir</label>
                                <input type="text" id="hari_kelahiran"
                                    value="{{ old('hari_kelahiran', $birth->hari_kelahiran) }}"
                                    class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor"
                                    readonly>
                                @error('hari_kelahiran')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Tempat Kelahiran -->
                            <div>
                                <label for="tempat_kelahiran" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                <input type="text" name="tempat_kelahiran" id="tempat_kelahiran" value="{{ old('tempat_kelahiran', $birth->tempat_kelahiran) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('tempat_kelahiran')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Alamat Anak -->
                            <div>
                                <label for="alamat_anak" class="block text-sm font-medium text-gray-700">Alamat Anak</label>
                                <input type="text" name="alamat_anak" id="alamat_anak" value="{{ old('alamat_anak', $birth->alamat_anak) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('alamat_anak')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Urutan Anak -->
                            <div>
                                <label for="urutan_anak" class="block text-sm font-medium text-gray-700">Urutan Anak Ke-</label>
                                <input type="text" name="urutan_anak" id="urutan_anak" value="{{ old('urutan_anak', $birth->urutan_anak) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('urutan_anak')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Total Saudara -->
                            <div>
                                <label for="total_saudara" class="block text-sm font-medium text-gray-700">Total Saudara</label>
                                <input type="text" name="total_saudara" id="total_saudara" value="{{ old('total_saudara', $birth->total_saudara) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('total_saudara')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
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
                                <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah', $birth->nama_ayah) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('nama_ayah')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Alamat Ayah -->
                            <div>
                                <label for="alamat_ayah" class="block text-sm font-medium text-gray-700">Alamat Ayah</label>
                                <input type="text" name="alamat_ayah" id="alamat_ayah" value="{{ old('alamat_ayah', $birth->alamat_ayah) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('alamat_ayah')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Nama Ibu -->
                            <div>
                                <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu', $birth->nama_ibu) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('nama_ibu')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Alamat Ibu -->
                            <div>
                                <label for="alamat_ibu" class="block text-sm font-medium text-gray-700">Alamat Ibu</label>
                                <input type="text" name="alamat_ibu" id="alamat_ibu" value="{{ old('alamat_ibu', $birth->alamat_ibu) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                @error('alamat_ibu')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <p class="py-2 text-sm font-medium text-center text-white rounded bg-mainColor">
                                Foto Persyaratan
                            </p>
                        </div>

                        <!-- Tambahkan di dalam <body> -->
                            <div x-data="{ showModal: false, modalImage: '' }">
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Foto KK -->
                                    <div class="mb-4">
                                        <label for="foto_kk" class="block text-sm font-medium text-gray-700">Foto KK</label>
                                        @if ($birth->foto_kk)
                                            <div class="mb-2">
                                                <img
                                                    src="{{ asset('storage/' . $birth->foto_kk) }}"
                                                    alt="Foto KK"
                                                    class="w-32 h-32 rounded shadow cursor-pointer"
                                                    @click="modalImage = '{{ asset('storage/' . $birth->foto_kk) }}'; showModal = true">
                                                <p class="mt-2 text-xs text-mainColor">Klik gambar untuk memperbesar</p>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Foto Akta Lahir -->
                                    <div class="mb-4">
                                        <label for="foto_akta_lahir" class="block text-sm font-medium text-gray-700">Foto Akta Kelahiran</label>
                                        @if ($birth->foto_akta_lahir)
                                            <div class="mb-2">
                                                <img
                                                    src="{{ asset('storage/' . $birth->foto_akta_lahir) }}"
                                                    alt="Foto Akta Lahir"
                                                    class="w-32 h-32 rounded shadow cursor-pointer"
                                                    @click="modalImage = '{{ asset('storage/' . $birth->foto_akta_lahir) }}'; showModal = true">
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
                                            class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor form-control">
                                            <option value="" hidden>Status Data</option>
                                            <option value="Disetujui" {{ $birth->status_data === 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                            <option value="Ditolak" {{ $birth->status_data === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
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
                                class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor form-control"
                                rows="3"
                                placeholder="Masukkan alasan penolakan...">{{ $birth->alasan_gagal }}</textarea>
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
                        <a href="{{ route('kelahiranadmin.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded hover:bg-gray-300">Tutup</a>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>
