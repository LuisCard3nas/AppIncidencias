<x-guest-layout>
    @section('title', 'Crear Cuenta')

    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Crear una cuenta! 🧾</h1>
        <p class="text-gray-600">Completa el formulario para registrarte</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre completo')" class="mb-2 font-medium text-gray-700" />
            <x-text-input 
                id="name" 
                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name"
                placeholder="Luis Cardenas" 
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" class="mb-2 font-medium text-gray-700" />
            <x-text-input 
                id="email" 
                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autocomplete="email"
                placeholder="ejemplo@correo.com" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role Selection -->
        <div>
            <x-input-label for="role_id" :value="__('Tipo de usuario')" class="mb-2 font-medium text-gray-700" />
            <select 
                id="role_id" 
                name="role_id" 
                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white"
                required>
                <option value="">Selecciona tu tipo de usuario</option>
                <option value="1" {{ old('role_id') == '1' ? 'selected' : '' }}>👤 Ciudadano</option>
                <option value="2" {{ old('role_id') == '2' ? 'selected' : '' }}>🏛️ Funcionario</option>
                <option value="3" {{ old('role_id') == '3' ? 'selected' : '' }}>⚙️ Administrador</option>
                <option value="4" {{ old('role_id') == '4' ? 'selected' : '' }}>👑 Alcalde</option>
            </select>
            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
            <p class="mt-2 text-sm text-gray-500">
                • <strong>Ciudadano:</strong> Reportar incidencias en tu comunidad<br>
                • <strong>Funcionario:</strong> Gestionar y resolver incidencias<br>
                • <strong>Administrador:</strong> Gestión completa del sistema<br>
                • <strong>Alcalde:</strong> Supervisión y toma de decisiones
            </p>
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
                autocomplete="new-password"
                placeholder="••••••••" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <p class="mt-2 text-sm text-gray-500">Mínimo 8 caracteres</p>
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="mb-2 font-medium text-gray-700" />
            <x-text-input 
                id="password_confirmation" 
                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                type="password" 
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                placeholder="••••••••" 
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <x-primary-button class="w-full btn-primary py-3 rounded-lg font-medium">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>

        <!-- Login Link -->
        <div class="text-center pt-6 border-t border-gray-200 mt-6">
            <p class="text-gray-600 text-sm">
                ¿Ya tienes cuenta? 
                <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">
                    Inicia sesión aquí
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>