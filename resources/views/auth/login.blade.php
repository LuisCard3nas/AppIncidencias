<x-guest-layout>
    @section('title', 'Iniciar Sesión')

    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Bienvenido de vuelta! 👋🏻</h1>
        <p class="text-gray-600">Ingresa tus credenciales para continuar</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" class="mb-2 font-medium text-gray-700" />
            <x-text-input 
                id="email" 
                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                placeholder="ejemplo@correo.com" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" class="mb-2 font-medium text-gray-700" />
            <x-text-input 
                id="password" 
                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                type="password" 
                name="password" 
                required 
                placeholder="••••••••" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ml-2 text-gray-600 text-sm">{{ __('Recordar sesión') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 hover:underline" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <x-primary-button class="w-full btn-primary py-3 rounded-lg font-medium">
                {{ __('Iniciar sesión') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div class="text-center pt-6 border-t border-gray-200 mt-6">
            <p class="text-gray-600 text-sm">
                ¿No tienes cuenta? 
                <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">
                    Regístrate aquí
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>