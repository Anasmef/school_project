<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="/images/svg/logo.png" alt="School Logo" class="w-40 h-30 mx-auto">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" class="text-blue-700" />
                <x-jet-input id="email" class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" class="text-blue-700" />
                <x-jet-input id="password" class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" class="text-blue-700" />
                    <span class="ml-2 text-sm text-blue-700">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-blue-700 hover:text-blue-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4 bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
