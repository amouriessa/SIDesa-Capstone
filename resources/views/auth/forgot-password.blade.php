<x-guest-layout>
    <div class="mb-4 text-sm text-justify text-gray-600 dark:text-gray-400">
        {{ __('Lupa password? Silahkan masukkan email yang sudah anda registrasikan, dan tekan tombol kirim. Kami akan mengirimkan email kepada anda, anda bisa mengeceknya dan klik reset password untuk mengganti password anda.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button class="px-10 py-2 text-sm font-semibold text-white uppercase rounded-md shadow-2xl ms-3 bg-mainColor hover:bg-darkerColor focus:outline-none">
                {{ __('Kirim Link Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
