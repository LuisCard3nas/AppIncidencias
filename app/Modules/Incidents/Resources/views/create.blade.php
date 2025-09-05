<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Crear Nueva Solicitud') }}
            </h2>
            <a href="{{ route('dashboard') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                🔙 Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Información del usuario -->
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <h3 class="font-semibold text-blue-800 mb-2">👤 Información del Solicitante</h3>
                        <p class="text-blue-700">
                            <strong>Nombre:</strong> {{ auth()->user()->name }}<br>
                            <strong>Email:</strong> {{ auth()->user()->email }}
                        </p>
                    </div>

                    <!-- Formulario -->
                    <form method="POST" action="{{ route('applications.store') }}" class="space-y-6">
                        @csrf

                        <!-- Tipo de Solicitud -->
                        <div>
                            <x-input-label for="type" :value="__('Tipo de Solicitud')" />
                            <select id="type" name="type" 
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                    required>
                                <option value="">Seleccione el tipo de solicitud...</option>
                                @foreach(\App\Models\Application::getTypes() as $key => $label)
                                    <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <!-- Ubicación -->
                        <div>
                            <x-input-label for="ubication" :value="__('Ubicación')" />
                            <x-text-input id="ubication" 
                                         class="block mt-1 w-full" 
                                         type="text" 
                                         name="ubication" 
                                         :value="old('ubication')" 
                                         required 
                                         placeholder="Ej: Calle 123 con Carrera 45, Barrio Centro" />
                            <p class="mt-1 text-sm text-gray-600">
                                📍 Especifique la dirección exacta o punto de referencia donde se presenta el problema
                            </p>
                            <x-input-error :messages="$errors->get('ubication')" class="mt-2" />
                        </div>

                        <!-- Descripción -->
                        <div>
                            <x-input-label for="descripcion" :value="__('Descripción Detallada')" />
                            <textarea id="descripcion" 
                                     name="descripcion" 
                                     rows="6"
                                     class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                     required 
                                     placeholder="Describa detalladamente el problema, cuándo ocurrió, frecuencia, afectación a la comunidad, etc.">{{ old('descripcion') }}</textarea>
                            <p class="mt-1 text-sm text-gray-600">
                                📝 Proporcione toda la información relevante que ayude a entender y resolver el problema
                            </p>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                        </div>

                        <!-- Información adicional -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <h4 class="font-semibold text-yellow-800 mb-2">ℹ️ Información Importante</h4>
                            <ul class="text-yellow-700 text-sm space-y-1">
                                <li>• Su solicitud será revisada por las autoridades competentes</li>
                                <li>• Recibirá notificaciones sobre el estado de su solicitud</li>
                                <li>• El estado inicial será "Pendiente" hasta que sea asignada</li>
                                <li>• Puede consultar el progreso en la sección "Mis Reportes"</li>
                            </ul>
                        </div>

                        <!-- Botones -->
                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('applications.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded transition duration-150">
                                Cancelar
                            </a>
                            <x-primary-button class="ms-4">
                                📝 {{ __('Crear Solicitud') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para mejorar UX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const descriptionTextarea = document.getElementById('descripcion');
            
            // Sugerencias de descripción según el tipo
            const suggestions = {
                'Baches': 'Describa el tamaño del bache, profundidad, ubicación exacta y si afecta el tráfico vehicular...',
                'Alumbrado': 'Indique si las luminarias están dañadas, fundidas, o si hay zonas sin iluminación...',
                'Limpieza': 'Especifique el tipo de residuos, frecuencia del problema, y área afectada...',
                'Agua_Potable': 'Describa si hay falta de agua, baja presión, o problemas de calidad...',
                'Alcantarillado': 'Indique si hay obstrucciones, desbordamientos, o malos olores...',
                'Transporte_Publico': 'Especifique problemas con rutas, frecuencia, o estado de paradas...',
                'Seguridad': 'Describa la situación de inseguridad y horarios en que se presenta...',
                'Ruido': 'Indique el tipo de ruido, horarios, y frecuencia del problema...',
                'Parques_Jardines': 'Describa el estado del área verde, mobiliario dañado, o falta de mantenimiento...',
                'Semaforos': 'Indique si están dañados, mal programados, o fuera de servicio...',
                'Señalizacion': 'Especifique qué señales faltan, están dañadas, o mal ubicadas...',
                'Otros': 'Describa detalladamente el problema que no encaja en las categorías anteriores...'
            };
            
            typeSelect.addEventListener('change', function() {
                const selectedType = this.value;
                if (selectedType && suggestions[selectedType]) {
                    descriptionTextarea.placeholder = suggestions[selectedType];
                }
            });
        });
    </script>
</x-app-layout>
