<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Información del Usuario -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">¡Bienvenido, {{ auth()->user()->name }}! 👋</h3>
                </div>
            </div>

            <!-- Acciones según el rol -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Acciones disponibles:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                        @if(auth()->user()->isCiudadano())
                            <a href="{{ route('applications.create') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="text-2xl mb-2">📝</div>
                                <h4 class="font-medium">Reportar Incidencia</h4>
                                <p class="text-sm text-gray-600">Reporta problemas en tu comunidad</p>
                            </a>
                            <a href="{{ route('applications.index') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="text-2xl mb-2">📋</div>
                                <h4 class="font-medium">Mis Reportes</h4>
                                <p class="text-sm text-gray-600">Ver el estado de mis incidencias</p>
                            </a>
                        @endif

                        @if(auth()->user()->isFuncionario())
                            <a href="#" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="text-2xl mb-2">📊</div>
                                <h4 class="font-medium">Gestionar Incidencias</h4>
                                <p class="text-sm text-gray-600">Asignar y actualizar reportes</p>
                            </a>
                            <a href="#" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="text-2xl mb-2">💬</div>
                                <h4 class="font-medium">Comunicaciones</h4>
                                <p class="text-sm text-gray-600">Comunicarse con ciudadanos</p>
                            </a>
                        @endif

                        @if(auth()->user()->isAdministrador())
                            <a href="#" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="text-2xl mb-2">👥</div>
                                <h4 class="font-medium">Gestión de Usuarios</h4>
                                <p class="text-sm text-gray-600">Administrar usuarios del sistema</p>
                            </a>
                            <a href="#" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="text-2xl mb-2">📈</div>
                                <h4 class="font-medium">Reportes</h4>
                                <p class="text-sm text-gray-600">Ver estadísticas del sistema</p>
                            </a>
                            <a href="#" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="text-2xl mb-2">⚙️</div>
                                <h4 class="font-medium">Configuración</h4>
                                <p class="text-sm text-gray-600">Configurar parámetros del sistema</p>
                            </a>
                        @endif

                        @if(auth()->user()->isAlcalde())
                            <a href="{{ route('applications.index') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="text-2xl mb-2">🏛️</div>
                                <h4 class="font-medium">Gestión de Aplicaciones</h4>
                                <p class="text-sm text-gray-600">Panel exclusivo del alcalde</p>
                            </a>
                            <a href="#" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="text-2xl mb-2">📊</div>
                                <h4 class="font-medium">Dashboard Ejecutivo</h4>
                                <p class="text-sm text-gray-600">Vista general de la gestión municipal</p>
                            </a>
                            <a href="#" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="text-2xl mb-2">💰</div>
                                <h4 class="font-medium">Presupuestos</h4>
                                <p class="text-sm text-gray-600">Aprobar y gestionar presupuestos</p>
                            </a>
                            <a href="#" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="text-2xl mb-2">🎯</div>
                                <h4 class="font-medium">Toma de Decisiones</h4>
                                <p class="text-sm text-gray-600">Decisiones estratégicas municipales</p>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
