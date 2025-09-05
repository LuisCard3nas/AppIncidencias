<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👁️ Ver Solicitud #{{ $application->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header con estado -->
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">
                                <span class="text-lg mr-2">
                                    @switch($application->type)
                                        @case('Baches') 🕳️ @break
                                        @case('Alumbrado') 💡 @break
                                        @case('Limpieza') 🧹 @break
                                        @case('Agua_Potable') 💧 @break
                                        @case('Alcantarillado') 🚰 @break
                                        @case('Transporte_Publico') 🚌 @break
                                        @case('Seguridad') 🛡️ @break
                                        @case('Ruido') 🔊 @break
                                        @case('Parques_Jardines') 🌳 @break
                                        @case('Semaforos') 🚦 @break
                                        @case('Señalizacion') 🚧 @break
                                        @default 📝
                                    @endswitch
                                </span>
                                {{ \App\Models\Application::getTypes()[$application->type] }}
                            </h3>
                            <p class="text-sm text-gray-600">Solicitud #{{ $application->id }}</p>
                        </div>
                        
                        <span class="px-4 py-2 text-sm rounded-full font-medium
                            @if($application->state === 'Pendiente') bg-yellow-100 text-yellow-800
                            @elseif($application->state === 'En_Revision') bg-blue-100 text-blue-800
                            @elseif($application->state === 'Derivada') bg-purple-100 text-purple-800
                            @elseif($application->state === 'En_Proceso') bg-blue-100 text-blue-800
                            @elseif($application->state === 'Solucionada') bg-green-100 text-green-800
                            @elseif($application->state === 'Rechazada') bg-red-100 text-red-800
                            @elseif($application->state === 'Cerrada') bg-gray-100 text-gray-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ \App\Models\Application::getStates()[$application->state] }}
                        </span>
                    </div>

                    <!-- Información del solicitante -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-3">👤 Información del Solicitante</h4>
                            <div class="space-y-2">
                                <p><strong>Nombre:</strong> {{ $application->user->name }}</p>
                                <p><strong>Email:</strong> {{ $application->user->email }}</p>
                                <p><strong>Rol:</strong> {{ $application->user->role->name }}</p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-3">👷 Información del Responsable</h4>
                            <div class="space-y-2">
                                @if($application->responsibleUser)
                                    <p><strong>Nombre:</strong> {{ $application->responsibleUser->name }}</p>
                                    <p><strong>Email:</strong> {{ $application->responsibleUser->email }}</p>
                                    <p><strong>Rol:</strong> {{ $application->responsibleUser->role->name }}</p>
                                @else
                                    <p class="text-gray-500 italic">Sin responsable asignado</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Detalles de la solicitud -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <h4 class="font-semibold text-gray-800 mb-4">📋 Detalles de la Solicitud</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Solicitud:</label>
                                <p class="text-gray-800">{{ \App\Models\Application::getTypes()[$application->type] }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Estado Actual:</label>
                                <p class="text-gray-800">{{ \App\Models\Application::getStates()[$application->state] }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Creación:</label>
                                <p class="text-gray-800">📅 {{ $application->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Última Actualización:</label>
                                <p class="text-gray-800">🕒 {{ $application->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ubicación:</label>
                            <p class="text-gray-800">📍 {{ $application->ubication }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción del Problema:</label>
                            <div class="bg-white p-4 rounded border text-gray-800 leading-relaxed">
                                {{ $application->descripcion }}
                            </div>
                        </div>
                    </div>

                    <!-- Información de seguimiento -->
                    <div class="bg-blue-50 p-4 rounded-lg mb-6">
                        <h4 class="font-semibold text-blue-800 mb-3">📊 Información de Seguimiento</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-blue-700 font-medium">ID de Solicitud:</span>
                                <span class="text-blue-800">#{{ $application->id }}</span>
                            </div>
                            <div>
                                <span class="text-blue-700 font-medium">Tiempo transcurrido:</span>
                                <span class="text-blue-800">{{ $application->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="flex justify-between items-center">
                        <a href="{{ route('applications.index') }}" 
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                            🔙 Volver al Listado
                        </a>

                        @if(auth()->user()->isAlcalde() || auth()->user()->isAdministrador())
                            <a href="{{ route('applications.edit', $application->id) }}" 
                               class="bg-yellow-500 hover:bg-yellow-700 text-black font-bold py-2 px-4 rounded transition duration-150">
                                ✏️ Gestionar Solicitud
                            </a>
                        @endif
                    </div>

                    <!-- Información del usuario actual -->
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-500">
                            Viendo como: <strong>{{ auth()->user()->name }}</strong> 
                            ({{ auth()->user()->role->name }})
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
