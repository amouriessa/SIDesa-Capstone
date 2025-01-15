<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login.penduduk') }}">
        @csrf

        <h1 class="mt-4 mb-4 font-bold text-center">LOGIN PENDUDUK</h1>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Forgot Pass -->
        <div class="block mt-4">
            @if (Route::has('password.request'))
                <a class="text-xs text-gray-600 underline hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>



        <div class="flex items-center justify-center mt-4">
            <button class="px-20 py-2 text-sm font-semibold text-white rounded-full shadow-2xl ms-3 bg-mainColor hover:bg-darkerColor focus:outline-none">
                {{ __('LOGIN') }}
            </button>
        </div>

        <!-- Registration Link -->
        <div class="mt-2 text-center">
            <a href="{{ route('register') }}" class="text-xs text-gray-600 underline hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                Belum punya akun? Daftar di sini
            </a>
        </div>
    </form>
</x-guest-layout>
