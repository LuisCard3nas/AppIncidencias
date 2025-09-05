<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(auth()->user()->isAlcalde())
                👑 Panel del Alcalde - Gestión de Aplicaciones
            @elseif(auth()->user()->isAdministrador())
                🛡️ Panel del Administrador - Gestión de Aplicaciones
            @else
                👤 Panel del Ciudadano - Ver Aplicaciones
            @endif
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">
                            @if(auth()->user()->isAlcalde())
                                🏛️ Gestión de Aplicaciones Municipales
                            @elseif(auth()->user()->isAdministrador())
                                🛡️ Administración de Solicitudes
                            @else
                                📋 Mis Aplicaciones y Reportes
                            @endif
                        </h3>
                        
                    </div>


                    <!-- Información del usuario -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @if(auth()->user()->isAlcalde() || auth()->user()->isAdministrador())
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-800">📊 Estadísticas</h4>
                                <p class="text-sm text-gray-600">Total de aplicaciones: {{ $applications->total() }}</p>
                                <p class="text-xs text-gray-500">Mostrando {{ $applications->count() }} de {{ $applications->total() }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-800">📋 Reportes</h4>
                                <p class="text-sm text-gray-600">Gestionar todas las aplicaciones</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-800">⚙️ Configuración</h4>
                                <p class="text-sm text-gray-600">Ajustes del sistema</p>
                            </div>
                        @else
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-800">📝 Mis Reportes</h4>
                                <p class="text-sm text-gray-600">Total de mis reportes: {{ $applications->total() }}</p>
                                <p class="text-xs text-gray-500">Mostrando {{ $applications->count() }} de {{ $applications->total() }}</p>
                            </div>
                            <a href="{{ route('applications.create') }}" class="block bg-blue-50 p-4 rounded-lg hover:bg-blue-100 transition">
                                <h4 class="font-semibold text-gray-800">📍 Nueva Incidencia</h4>
                            </a>
                        @endif
                    </div>

                    <!-- Lista de Aplicaciones -->
                    @if($applications->count() > 0)
                        <div class="mt-8">
                            <div class="flex justify-between items-center mb-6">
                                <h4 class="text-lg font-semibold">
                                    @if(auth()->user()->isAlcalde() || auth()->user()->isAdministrador())
                                        📋 Todas las Solicitudes
                                    @else
                                        📝 Mis Solicitudes
                                    @endif
                                    <span class="text-sm font-normal text-gray-500">
                                        ({{ $applications->total() }} total{{ $applications->total() !== 1 ? 'es' : '' }})
                                    </span>
                                </h4>
                                
                                <!-- Filtros rápidos -->
                                <div class="flex space-x-2">
                                    <span class="text-sm text-gray-600">Filtrar por estado:</span>
                                    <select onchange="window.location.href=this.value" class="text-xs border border-gray-300 rounded px-2 py-1">
                                        <option value="{{ route('applications.index') }}">Todos los estados</option>
                                        @foreach(\App\Models\Application::getStates() as $stateKey => $stateName)
                                            <option value="{{ route('applications.index', ['state' => $stateKey]) }}" 
                                                    {{ request('state') === $stateKey ? 'selected' : '' }}>
                                                {{ $stateName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="space-y-6">
                                @foreach($applications as $application)
                                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-all duration-300 bg-white">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-3 mb-3">
                                                    <span class="text-xl">
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
                                                    <h5 class="font-semibold text-gray-800 text-lg">
                                                        {{ \App\Models\Application::getTypes()[$application->type] }}
                                                    </h5>
                                                    <span class="px-3 py-1 text-sm rounded-full font-medium
                                                        @if($application->state === 'Pendiente') bg-yellow-100 text-yellow-800
                                                        @elseif($application->state === 'En_Proceso') bg-blue-100 text-blue-800
                                                        @elseif($application->state === 'Solucionada') bg-green-100 text-green-800
                                                        @elseif($application->state === 'Rechazada') bg-red-100 text-red-800
                                                        @else bg-gray-100 text-gray-800
                                                        @endif">
                                                        {{ \App\Models\Application::getStates()[$application->state] }}
                                                    </span>
                                                </div>
                                                
                                                <p class="text-sm text-gray-600 mb-3">
                                                    <strong>📍 Ubicación:</strong> {{ $application->ubication }}
                                                </p>
                                                
                                                <p class="text-sm text-gray-700 mb-3 leading-relaxed">
                                                    {{ Str::limit($application->descripcion, 150) }}
                                                </p>
                                                
                                                <div class="text-xs text-gray-500 space-y-1">
                                                    @if(auth()->user()->isAlcalde() || auth()->user()->isAdministrador())
                                                        <div>👤 <strong>Reportado por:</strong> {{ $application->user->name }}</div>
                                                    @endif
                                                    @if($application->responsibleUser)
                                                        <div>👷 <strong>Responsable:</strong> {{ $application->responsibleUser->name }}</div>
                                                    @endif
                                                    <div>📅 <strong>Fecha:</strong> {{ $application->created_at->format('d/m/Y H:i') }}</div>
                                                </div>
                                            </div>
                                            
                                            <div class="flex flex-col space-y-3 ml-6">
                                                <a href="{{ route('applications.show', $application->id) }}" 
                                                   class="bg-blue-500 hover:bg-blue-700 text-black text-sm px-4 py-2 rounded-lg font-medium transition duration-200">
                                                    Ver Detalles
                                                </a>
                                                @if(auth()->user()->isAlcalde() || auth()->user()->isAdministrador())
                                                    <a href="{{ route('applications.edit', $application->id) }}" 
                                                       class="bg-yellow-500 hover:bg-yellow-600 text-black text-sm px-4 py-2 rounded-lg font-medium transition duration-200">
                                                        Gestionar
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Paginación Simple -->
                            @if($applications->hasPages())
                                <div class="mt-8 flex justify-center">
                                    <div class="bg-white border border-gray-200 rounded-lg px-6 py-4 shadow-sm">
                                        <div class="flex items-center space-x-4">
                                            <!-- Botón Anterior -->
                                            @if ($applications->onFirstPage())
                                                <span class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                                    ← Anterior
                                                </span>
                                            @else
                                                <a href="{{ $applications->appends(request()->query())->previousPageUrl() }}" 
                                                   class="px-4 py-2 text-sm text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                                                    ← Anterior
                                                </a>
                                            @endif

                                            <!-- Información de página -->
                                            <span class="text-sm text-gray-600">
                                                Página {{ $applications->currentPage() }} de {{ $applications->lastPage() }}
                                            </span>

                                            <!-- Botón Siguiente -->
                                            @if ($applications->hasMorePages())
                                                <a href="{{ $applications->appends(request()->query())->nextPageUrl() }}" 
                                                   class="px-4 py-2 text-sm text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                                                    Siguiente →
                                                </a>
                                            @else
                                                <span class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                                    Siguiente →
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <!-- Info adicional -->
                                        <div class="mt-2 text-center">
                                            <span class="text-xs text-gray-500">
                                                Mostrando {{ $applications->firstItem() ?? 0 }} - {{ $applications->lastItem() ?? 0 }} de {{ $applications->total() }} resultados
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="mt-8 text-center py-8">
                            <div class="text-4xl mb-4">📝</div>
                            <h4 class="text-lg font-semibold text-gray-600 mb-2">
                                @if(auth()->user()->isAlcalde() || auth()->user()->isAdministrador())
                                    No hay solicitudes registradas en el sistema
                                @else
                                    No has registrado ninguna solicitud aún
                                @endif
                            </h4>
                            <p class="text-gray-500 mb-4">
                                @if(auth()->user()->isAlcalde() || auth()->user()->isAdministrador())
                                    Cuando los ciudadanos reporten incidencias, aparecerán aquí.
                                @else
                                    ¡Reporta tu primera incidencia para que la municipalidad pueda ayudarte!
                                @endif
                            </p>
                            @if(!auth()->user()->isAlcalde() && !auth()->user()->isAdministrador())
                                <a href="{{ route('applications.create') }}" 
                                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    📝 Reportar Primera Incidencia
                                </a>
                            @endif
                        </div>
                    @endif

                    <div class="mt-8">
                        <p class="text-sm text-gray-500">
                            Usuario actual: <strong>{{ auth()->user()->name }}</strong> 
                            ({{ auth()->user()->role->name }})
                        </p>
                    </div>
                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('dashboard') }}" 
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                            🔙 Volver
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
