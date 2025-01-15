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

    <div class="relative flex min-h-screen md:flex">
        <aside class="absolute inset-y-0 left-0 z-10 w-64 px-2 py-4 overflow-y-auto md:relative">
            @include('components/sidebar')
        </aside>

        <div class="relative flex-1 max-w-full mr-10 overflow-hidden sm:px-6 lg:px-8">
            <div class="py-12">
                <div class="max-w-full mx-auto">
                    <div class="overflow-hidden bg-white drop-shadow dark:bg-gray-800 sm:rounded-lg">
                        <div class="p-3 ml-3 text-lg font-bold text-black dark:text-gray-100">
                            {{ __("Data Persyaratan") }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="items-center mx-auto">
                <div class="flex items-center w-full max-w-3xl space-x-4">
                    <div class="relative">
                        <a href="{{ route('datapersyaratan.create') }}">
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
                    <table class="min-w-full table-auto">
                        <thead class="sticky top-0 border-b border-gray-200 bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-sm font-bold tracking-wider text-center text-black whitespace-nowrap">Tentang Website</th>
                                <th class="px-4 py-3 text-sm font-bold tracking-wider text-center text-black whitespace-nowrap">Persyaratan Kelahiran</th>
                                <th class="px-4 py-3 text-sm font-bold tracking-wider text-center text-black whitespace-nowrap">Persyaratan Kematian</th>
                                <th class="px-4 py-3 text-sm font-bold tracking-wider text-center text-black whitespace-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_persyaratan as $persyaratan)
                                <tr>
                                    <td class="px-6 py-4 text-sm break-words whitespace-normal align-top">{{ $persyaratan->tentang_website }}</td>
                                    <td class="px-6 py-4 text-sm break-words whitespace-pre-wrap align-baseline">{{ $persyaratan->persyaratan_kelahiran }}</td>
                                    <td class="px-6 py-4 text-sm break-words whitespace-pre-wrap align-baseline">{{ $persyaratan->persyaratan_kematian }}</td>
                                    <td class="px-6 py-4 text-sm text-center whitespace-nowrap">
                                        <div class="flex justify-center space-x-2 btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('datapersyaratan.edit', $persyaratan->id) }}" type="button" class="px-4 py-2 text-xs text-white bg-gray-500 rounded-lg hover:bg-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('datapersyaratan.destroy', $persyaratan->id) }}" method="POST" id="delete-form-{{ $persyaratan->id }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="px-4 py-2 text-xs text-white bg-red-500 rounded-lg hover:bg-red-600" onclick="confirmDelete({{ $persyaratan->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                      </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

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
