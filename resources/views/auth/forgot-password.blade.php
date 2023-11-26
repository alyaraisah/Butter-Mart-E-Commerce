<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Lupa kata sandi? Tidak masalah. Silakan berikan alamat email Anda dan kami akan mengirimkan tautan reset kata sandi agar Anda dapat membuat kata sandi baru.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Email sudah dikirim! Silakan periksa kotak masuk atau folder spam untuk tautan reset kata sandi.') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan Email yang Sudah Terdaftar" style="font-size: 13px;" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Tautan Email Reset Kata Sandi') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
