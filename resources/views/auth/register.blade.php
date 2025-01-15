<x-guest-layout>
    <form method="POST" action="{{ route('penduduk.store') }}">
        @csrf

        <h1 class="mt-4 mb-4 font-bold text-center">REGISTER</h1>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="nama" :value="__('Nama Lengkap')" />
            <x-text-input id="nama" class="block w-full mt-1" type="text" name="nama" :value="old('nama')" required autofocus autocomplete="nama" />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        <!-- NIK -->
        {{-- <div class="mt-4">
            <x-input-label for="nik" :value="__('NIK')" />
            <x-text-input id="nik" class="block w-full mt-1" type="text" name="nik" :value="old('nik')" required autofocus autocomplete="nik" />
            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
        </div> --}}

        <!-- No Telpon -->
        <div class="mt-4">
            <x-input-label for="no_telepon" :value="__('No Telepon')" />
            <x-text-input id="no_telepon" class="block w-full mt-1" type="text" name="no_telepon" :value="old('no_telepon')" required autofocus autocomplete="no_telepon" />
            <x-input-error :messages="$errors->get('no_telepon')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Password Confirmation -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

            <x-text-input id="password_confirmation" class="block w-full mt-1"
                            type="password"
                            name="password_confirmation"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>


        <div class="flex items-center justify-center mt-4">
            <button class="px-20 py-2 text-sm font-semibold text-white rounded-full shadow-2xl ms-3 bg-mainColor hover:bg-darkerColor focus:outline-none">
                {{ __('Register') }}
            </button>
        </div>

        <div class="mt-2 text-center">
            <a class="text-xs text-gray-600 underline hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" href="{{ route('login.penduduk') }}">
                {{ __('Sudah memiliki akun? Login disini') }}
            </a>
        </div>
    </form>
</x-guest-layout>
