<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Editar Solicitud #{{ $application->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Mensaje de error -->
            @if($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Información de la solicitud (solo lectura) -->
                    <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800">📋 Información de la Solicitud</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Solicitud:</label>
                                <div class="flex items-center space-x-2">
                                    <span class="text-lg">
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
                                    <span class="font-medium">{{ \App\Models\Application::getTypes()[$application->type] }}</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Solicitante:</label>
                                <p class="text-gray-800">👤 {{ $application->user->name }}</p>
                                <p class="text-sm text-gray-600">📧 {{ $application->user->email }}</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ubicación:</label>
                                <p class="text-gray-800">📍 {{ $application->ubication }}</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Descripción:</label>
                                <p class="text-gray-800 bg-white p-3 rounded border">{{ $application->descripcion }}</p>
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
                    </div>

                    <!-- Formulario de edición -->
                    <form method="POST" action="{{ route('applications.update', $application->id) }}">
                        @csrf
                        @method('PUT')

                        <h3 class="text-lg font-semibold mb-4 text-gray-800">⚙️ Gestión de la Solicitud</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Estado -->
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700 mb-2">
                                    📊 Estado de la Solicitud *
                                </label>
                                <select id="state" name="state" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @foreach(\App\Models\Application::getStates() as $stateKey => $stateName)
                                        <option value="{{ $stateKey }}" {{ $application->state === $stateKey ? 'selected' : '' }}>
                                            {{ $stateName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('state')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Responsable -->
                            <div>
                                <label for="responsible_user_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    👷 Responsable de la Solicitud
                                </label>
                                <select id="responsible_user_id" name="responsible_user_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">-- Sin asignar --</option>
                                    @php
                                        $funcionarios = \App\Models\User::whereHas('role', function($query) {
                                            $query->whereIn('slug', ['funcionario', 'administrador']);
                                        })->get();
                                    @endphp
                                    @foreach($funcionarios as $funcionario)
                                        <option value="{{ $funcionario->id }}" 
                                                {{ $application->responsible_user_id == $funcionario->id ? 'selected' : '' }}>
                                            {{ $funcionario->name }} ({{ $funcionario->role->name }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('responsible_user_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">
                                    Solo funcionarios y administradores pueden ser asignados como responsables.
                                </p>
                            </div>
                        </div>

                        <!-- Estado actual -->
                        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                            <h4 class="font-semibold text-blue-800 mb-2">📊 Estado Actual</h4>
                            <div class="flex items-center space-x-2">
                                <span class="px-3 py-1 text-sm rounded-full 
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
                                @if($application->responsibleUser)
                                    <span class="text-sm text-gray-600">
                                        👷 Responsable: <strong>{{ $application->responsibleUser->name }}</strong>
                                    </span>
                                @else
                                    <span class="text-sm text-gray-500">👷 Sin responsable asignado</span>
                                @endif
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="mt-8 flex justify-between">
                            <a href="{{ route('applications.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                                🔙 Volver al Listado
                            </a>
                            
                            <div class="space-x-2">
                                <a href="{{ route('applications.show', $application->id) }}" 
                                   class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded transition duration-150">
                                    👁️ Ver Detalles Completos
                                </a>
                                <button type="submit" 
                                        class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded transition duration-150">
                                    💾 Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
