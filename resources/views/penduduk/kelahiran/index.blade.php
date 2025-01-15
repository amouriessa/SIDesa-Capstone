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

    <script>
        function filterTable() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const table = document.getElementById("dataTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) { // Mulai dari 1 untuk melewati header
                const cells = rows[i].getElementsByTagName("td");
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    const cellContent = cells[j].textContent || cells[j].innerText;
                    if (cellContent.toLowerCase().includes(input)) {
                        match = true;
                        break;
                    }
                }

                rows[i].style.display = match ? "" : "none";
            }
        }
    </script>


</head>
<body class="antialiased bg-gray-100">
    <div class="relative flex min-h-screen md:flex">
        <aside class="absolute inset-y-0 left-0 z-10 w-64 px-2 py-4 overflow-y-auto md:relative">
            @include('components/sidebar-penduduk')
        </aside>

        <div class="relative flex-1 max-w-full mr-10 overflow-hidden sm:px-6 lg:px-8">
            <div class="py-12">
                <div class="max-w-full mx-auto">
                    <div class="overflow-hidden bg-white drop-shadow dark:bg-gray-800 sm:rounded-lg">
                        <div class="p-3 ml-3 text-lg font-bold text-black dark:text-gray-100">
                            {{ __("Permohonan Kelahiran") }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="items-center mx-auto">
                <div class="flex items-center w-full max-w-3xl space-x-4">
                    <!-- Search Input -->
                    <div class="relative">
                        <input
                            id="searchInput"
                            type="text"
                            placeholder="Cari Data"
                            class="flex py-1 pl-5 text-sm border border-gray-300 rounded-lg focus:border-green-500 placeholder:text-sm placeholder:font-normal focus:text-sm"
                            oninput="filterTable()"
                        >
                    </div>

                    <div class="relative">
                        <!-- Filter Status -->
                        <div class="relative inline-block"
                            x-data="{
                                open: false,
                                filters: [],
                                applyFilters() {
                                    const rows = document.querySelectorAll('#dataTable tbody tr');
                                    rows.forEach(row => {
                                        const statusCell = row.querySelector('td:nth-child(3)');
                                        const status = statusCell ? statusCell.textContent.trim() : '';
                                        row.style.display = this.filters.length === 0 || this.filters.includes(status) ? '' : 'none';
                                    });
                                }
                            }">
                            <button @click="open = !open"
                                class="px-4 py-2 text-sm font-semibold text-white transition duration-200 rounded-lg bg-mainColor hover:bg-darkerColor">
                                Filter Status
                            </button>
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200 transform"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150 transform"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute z-10 w-48 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow">
                                <ul class="px-4 py-2 text-xs text-left">
                                    <li class="flex items-center py-1 space-x-2 rounded cursor-pointer hover:bg-gray-100">
                                        <input type="checkbox" x-model="filters" value="Diajukan"
                                            class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring-blue-400"
                                            @change="applyFilters()">
                                        <label class="text-gray-700">Diajukan</label>
                                    </li>
                                    <li class="flex items-center py-1 space-x-2 rounded cursor-pointer hover:bg-gray-100">
                                        <input type="checkbox" x-model="filters" value="Disetujui"
                                            class="w-4 h-4 text-green-500 border-gray-300 rounded focus:ring-green-400"
                                            @change="applyFilters()">
                                        <label class="text-gray-700">Disetujui</label>
                                    </li>
                                    <li class="flex items-center py-1 space-x-2 rounded cursor-pointer hover:bg-gray-100">
                                        <input type="checkbox" x-model="filters" value="Ditolak"
                                            class="w-4 h-4 text-red-500 border-gray-300 rounded focus:ring-red-400"
                                            @change="applyFilters()">
                                        <label class="text-gray-700">Ditolak</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <a href="{{ route('kelahiranpenduduk.create') }}">
                            <button type="submit" class="px-4 py-2 text-sm font-semibold text-white transition duration-200 rounded-lg bg-mainColor hover:bg-darkerColor">
                                Tambah Data
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Permohonan yang belum diverifikasi --}}
            <div class="max-w-full p-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg drop-shadow">
                <div class="overflow-x-auto">
                    <table id="dataTable" class="min-w-full">
                        <thead class="sticky top-0 border-b border-gray-200 bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-sm font-bold tracking-wider text-center text-black whitespace-nowrap">No</th>
                                {{-- <th class="px-4 py-3 text-sm font-bold tracking-wider text-center text-black whitespace-nowrap">Nomor Surat</th> --}}
                                <th class="px-4 py-3 text-sm font-bold tracking-wider text-center text-black whitespace-nowrap">Nama Bayi</th>
                                <th class="px-4 py-3 text-sm font-bold tracking-wider text-center text-black whitespace-nowrap">Status</th>
                                <th class="px-4 py-3 text-sm font-bold tracking-wider text-center text-black whitespace-nowrap">Ket</th>
                                <th class="px-4 py-3 text-sm font-bold tracking-wider text-center text-black whitespace-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($births as $item)
                            <tr>
                                <td class="px-6 py-4 text-sm text-center whitespace-nowrap">{{ $loop->iteration }}</td>
                                {{-- <td class="px-6 py-4 text-sm text-center whitespace-nowrap">{{ $item->nomor_surat }}</td> --}}
                                <td class="px-6 py-4 text-sm text-center whitespace-nowrap">{{ $item->nama_anak }}</td>
                                <td class="px-6 py-4 text-sm text-center whitespace-nowrap">{{ $item->status_data }}</td>
                                <td class="px-6 py-4 text-sm text-center whitespace-nowrap">
                                    @if($item->status_data === 'Ditolak')
                                        {{ $item->alasan_gagal }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-2" aria-label="Basic example">
                                        <a href="{{ route('kelahiranpenduduk.edit', $item->id) }}" type="button" class="items-center justify-center px-4 py-2 text-xs text-white bg-gray-500 rounded-lg hover:bg-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>

                                        <!-- Download PDF Button (Only if status is "Berhasil Verifikasi") -->
                                        @if($item->status_data === 'Disetujui')
                                        <a href="{{ route('kelahiranpenduduk.downloadPdf', $item->id) }}" class="px-4 py-2 text-xs text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                              </svg>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center text-red-500" colspan="7">Data kelahiran tidak ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
