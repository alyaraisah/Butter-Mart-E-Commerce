<x-guest-layout>
    <x-authentication-card>
        <!-- Bagian Form Masuk -->
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />
        <!-- Menampilkan pesan sukses reset kata sandi -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Kata Sandi Anda telah Di Reset') }}
            </div>
        @endif

        <!-- Form untuk masuk -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan Email Terdaftar" style="font-size: 13px;"/>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Kata Sandi') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan Kata Sandi" style="font-size: 13px;"/>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Ingat Kata Sandi') }}</span>
                </label>
            </div>

            <!-- Link lupa kata sandi -->
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Lupa Kata Sandi?') }}
                    </a>
                @endif

                <!-- Link untuk mendaftar -->
                <a class="ml-4 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                {{ __('Daftar') }}
                </a>

                <!-- Tombol untuk masuk -->
                <x-button class="ml-4">
                    {{ __('Masuk') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
