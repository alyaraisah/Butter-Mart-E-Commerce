<x-app-layout style="margin-top: -100px;">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif

            <div class="mt-10 text-center">
                @if(Gate::allows('isAdmin'))
                    <a href="{{ url('/') }}" class="text-gray-600 hover:text-gray-1000 font-semibold inline-block border border-gray-400 rounded-md py-2 px-4 hover:bg-gray-100">
                        &larr; Kembali ke Halaman Utama
                    </a>
                @else
                    <a href="{{ url('/redirect') }}" class="text-gray-600 hover:text-gray-1000 font-semibold inline-block border border-gray-400 rounded-md py-2 px-4 hover:bg-gray-100">
                        &larr; Kembali ke Halaman Utama
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
