<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Desa Sidorejo</title>

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
                <a href="/daftaruser" class="text-sm font-bold text-white hover:underline">Manajemen User</a>
                <a href="/" class="text-sm font-bold text-white hover:underline">Edit User</a>
            </nav>
        </div>
    </header>

    <main class="container px-6 py-20 mx-auto">
        <div class="items-center">

            <h2 class="mb-8 text-2xl font-bold text-center">Edit User</h2>

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

                <form action="{{ route('daftaruser.update', $user->id) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        {{-- <div>
                            <p class="py-2 text-sm font-medium text-center text-white rounded bg-mainColor">
                                Informasi Almarhum
                            </p>
                        </div> --}}

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Nama -->
                            <div class="mb-4">
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>

                            <!-- No Telp -->
                            <div class="mb-4">
                                <label for="no_telepon" class="block text-sm font-medium text-gray-700">No Telepon</label>
                                <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon ?? '') }}"  class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="text" name="email" rows="3" value="{{ old('email', $user->email) }}" class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                                <input
                                    type="password"
                                    name="password"
                                    class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ingin mengubah password.</p>
                            </div>

                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Role -->
                            <div class="flex items-center mb-4">
                                <div class="w-full">
                                    <label for="role" class="block text-sm font-medium text-gray-700">
                                        User Role
                                    </label>
                                    <div class="relative">
                                        <select
                                            id="role"
                                            name="role"
                                            class="block w-full px-4 py-2 mt-1 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-mainColor focus:border-mainColor">
                                            <option value="" hidden>Pilih Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="penduduk">Penduduk</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="flex items-center justify-end mt-6 space-x-4">
                            <button type="submit" class="px-6 py-2 text-sm font-bold text-white rounded-lg shadow-md bg-mainColor hover:bg-mainColorHover focus:outline-none">Update User</button>
                            <a href="{{ route('daftaruser.index') }}" class="px-6 py-2 text-sm font-bold text-black bg-gray-300 rounded-lg shadow-md hover:bg-gray-400 focus:outline-none">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
