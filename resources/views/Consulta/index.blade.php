<x-guest-layout title="Consulta de Exámenes | FCFM">
    
    @push('styles')
        @vite(['resources/css/views/consulta.css'])
    @endpush

    <section class="bg-white shadow-md rounded-lg p-6 mb-8 mt-4">
        <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Filtrar Búsqueda</h2>
        
        <form id="filter-form" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="form-group">
                <label for="select-carrera" class="block text-sm font-medium text-gray-700 mb-1">Carrera</label>
                <select id="select-carrera" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Seleccione una carrera...</option>
                    @foreach($carreras as $carrera)
                        <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="select-semestre" class="block text-sm font-medium text-gray-700 mb-1">Semestre</label>
                <select id="select-semestre" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" disabled>
                    <option value="">Esperando carrera...</option>
                </select>
            </div>

            <div class="form-group">
                <label for="select-materia" class="block text-sm font-medium text-gray-700 mb-1">Unidad de Aprendizaje</label>
                <select id="select-materia" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" disabled>
                    <option value="">Todas</option>
                </select>
            </div>
        </form>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-blue-900 text-white p-4 text-center">
                    <h3 class="font-bold text-lg" id="current-month-label">Enero 2026</h3>
                </div>
                <div class="calendar-grid p-4" id="calendar-grid">
                    <div class="day-name">Dom</div>
                    <div class="day-name">Lun</div>
                    <div class="day-name">Mar</div>
                    <div class="day-name">Mié</div>
                    <div class="day-name">Jue</div>
                    <div class="day-name">Vie</div>
                    <div class="day-name">Sáb</div>
                    
                    <div class="day-cell empty"></div>
                    <div class="day-cell">1</div>
                    <div class="day-cell has-exam">2</div>
                    <div class="day-cell current-day">3</div>
                    </div>
            </div>
        </div>

        <div class="lg:col-span-2" id="results-container">
            
            <div class="materia-card bg-white shadow-md rounded-lg mb-6 overflow-hidden">
                <div class="bg-gray-100 border-b border-gray-200 px-6 py-3 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-blue-900">Programación Web</h3>
                    <span class="text-sm text-gray-500 font-medium">Semestre 5</span>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <div class="grupo-card border rounded-md p-4 hover:shadow-md transition">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="font-bold text-gray-700">Grupo 051</h4>
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Ordinario</span>
                        </div>
                        
                        <ul class="space-y-2">
                            <li class="text-sm flex justify-between">
                                <span class="text-gray-600">1er Parcial:</span>
                                <span class="font-medium">10 Ene - 14:00</span>
                            </li>
                            <li class="text-sm flex justify-between">
                                <span class="text-gray-600">2do Parcial:</span>
                                <span class="font-medium">15 Feb - 14:00</span>
                            </li>
                        </ul>
                    </div>

                    <div class="grupo-card border rounded-md p-4 hover:shadow-md transition">
                         <div class="flex justify-between items-center mb-3">
                            <h4 class="font-bold text-gray-700">Grupo 052</h4>
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Ordinario</span>
                        </div>
                        </div>

                </div>
            </div>
            </div>
    </div>

    @push('scripts')
        @vite(['resources/js/views/consulta.js'])
    @endpush

</x-guest-layout>