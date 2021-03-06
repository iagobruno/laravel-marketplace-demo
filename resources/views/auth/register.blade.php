<x-guest-layout>
    <x-auth-card>
        <x-slot name="before">
            <a href="/" class="flex flex-col items-center mb-2">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>

            <h2 class="text-4xl font-bold text-center">{{ __('Welcome to') . ' ' . config('app.name', 'Laravel') }}!
            </h2>
            <p class="text-gray-700 text-center mt-2">
                {{ __('Already registered?') }} <a href="{{ route('login') }}"
                    class="text-blue-600 hover:text-blue-900 hover:underline">{{ __('Login') }}</a>
            </p>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="fname" :value="__('First name')" />

                <x-input id="fname" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')"
                    required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="lname" :value="__('Last name')" />

                <x-input id="lname" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')"
                    required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
