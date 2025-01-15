<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Sidorejo</title>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/landingpage/logo.png') }}">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Search Functionality -->
    <script>
        function filterTable() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const rows = document.querySelectorAll("#dataTable tbody tr");

            rows.forEach(row => {
                const cells = Array.from(row.querySelectorAll("td"));
                const match = cells.some(cell => cell.textContent.toLowerCase().includes(input));
                row.style.display = match ? "" : "none";
            });
        }
    </script>
</head>

<body class="antialiased bg-gray-100">
    <div class="relative flex min-h-screen md:flex">
        <!-- Sidebar -->
        <aside class="absolute inset-y-0 left-0 z-10 w-64 px-2 py-4 overflow-y-auto md:relative">
            @include('components.sidebar')
        </aside>

        <!-- Main Content -->
        <div class="relative flex-1 max-w-full overflow-hidden sm:px-6 lg:px-8">
            <div class="py-12">
                <div class="max-w-full mx-auto">
                    <div class="overflow-hidden bg-white drop-shadow dark:bg-gray-800 sm:rounded-lg">
                        <div class="p-3 ml-3 text-lg font-bold text-black dark:text-gray-100">
                            {{ __("Manajemen User") }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="items-center mx-auto">
                <div class="flex items-center w-full max-w-3xl space-x-4">
                    <!-- Search -->
                    <input id="searchInput" type="text" placeholder="Cari Data"
                        class="flex py-1 pl-5 text-sm border border-gray-300 rounded-lg focus:border-green-500 placeholder:text-sm placeholder:font-normal focus:text-sm"
                        oninput="filterTable()">

                    <!-- Filter -->
                    <div class="relative">
                        <!-- Filter Status -->
                        <div class="relative inline-block"
                            x-data="{
                                open: false,
                                filters: [],
                                applyFilters() {
                                    const rows = document.querySelectorAll('#dataTable tbody tr');
                                    rows.forEach(row => {
                                        const statusCell = row.querySelector('td:nth-child(4)');
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
                                        <input type="checkbox" x-model="filters" value="admin"
                                            class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring-blue-400"
                                            @change="applyFilters()">
                                        <label class="text-gray-700">Admin</label>
                                    </li>
                                    <li class="flex items-center py-1 space-x-2 rounded cursor-pointer hover:bg-gray-100">
                                        <input type="checkbox" x-model="filters" value="penduduk"
                                            class="w-4 h-4 text-green-500 border-gray-300 rounded focus:ring-green-400"
                                            @change="applyFilters()">
                                        <label class="text-gray-700">Penduduk</label>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- <div x-data="{ open: false }" x-init="$watch('filters', () => filterTable())">
                        <button @click="open = !open"
                            class="px-4 py-2 text-sm font-semibold text-white rounded-lg bg-mainColor hover:bg-darkerColor">
                            Filter User
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute z-10 w-48 p-2 mt-2 bg-white rounded-lg shadow">
                            <ul class="text-sm">
                                <template x-for="role in ['admin', 'penduduk']" :key="role">
                                    <li class="flex items-center py-1 space-x-2">
                                        <input type="checkbox" x-model="filters" :value="role"
                                            @change="applyFilters()" class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring">
                                        <label x-text="role" class="text-gray-700"></label>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div> --}}

                    <!-- Add User -->
                    <a href="{{ route('daftaruser.create') }}">
                        <button class="px-4 py-2 text-sm font-semibold text-white rounded-lg bg-mainColor hover:bg-darkerColor">
                            Tambah User
                        </button>
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="max-w-full p-6 mx-auto mt-10 bg-white rounded-lg drop-shadow">
                <div class="overflow-x-auto">
                    <table id="dataTable" class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-sm font-bold text-center">No</th>
                                <th class="px-4 py-3 text-sm font-bold text-center">Nama</th>
                                <th class="px-4 py-3 text-sm font-bold text-center">Email</th>
                                <th class="px-4 py-3 text-sm font-bold text-center">Role</th>
                                <th class="px-4 py-3 text-sm font-bold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse ($users as $item)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-center">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm text-center">{{ $item->nama }}</td>
                                    <td class="px-6 py-4 text-sm text-center">{{ $item->email }}</td>
                                    <td class="px-6 py-4 text-sm text-center">
                                        {{ implode(', ', $item->roles->pluck('name')->toArray()) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center">
                                        <div class="flex justify-center space-x-2 btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('daftaruser.edit', $item->id) }}"
                                                class="px-4 py-2 text-xs text-white bg-gray-500 rounded-lg hover:bg-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('daftaruser.destroy', $item->id) }}" method="POST" id="delete-form-{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="px-4 py-2 text-xs text-white bg-red-500 rounded-lg hover:bg-red-600" onclick="confirmDelete({{ $item->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-red-500">User tidak ditemukan</td>
                                </tr>
                            @endforelse

                            <script>
                                function confirmDelete(itemId) {
                                    const confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
                                    if (confirmation) {
                                        document.getElementById('delete-form-' + itemId).submit();
                                    }
                                }
                            </script>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
