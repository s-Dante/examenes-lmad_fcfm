@extends('layouts.public')

@section('title', 'Consulta de Exámenes - FCFM')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
@endpush

@section('content')

    <x-alert-banner message="Las fechas asignadas para el tercer parcial serán proporcionadas por la Facultad." />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">🔍 Filtros de Búsqueda</h2>
            
            <form action="{{ route('inicio') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div>
                    <label for="semestre" class="block text-sm font-medium text-gray-700 mb-1">Semestre</label>
                    <select name="semestre" id="semestre" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Todos</option>
                        @for($i=1; $i<=9; $i++)
                            <option value="{{ $i }}" {{ request('semestre') == $i ? 'selected' : '' }}>{{ $i }}° Semestre</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label for="q" class="block text-sm font-medium text-gray-700 mb-1">Unidad de Aprendizaje / Grupo</label>
                    <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="Ej: Cálculo, 004..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Examen</label>
                    <select name="tipo" id="tipo" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Todos</option>
                        <option value="parcial_1" {{ request('tipo') == 'parcial_1' ? 'selected' : '' }}>1er Parcial</option>
                        <option value="ordinario" {{ request('tipo') == 'ordinario' ? 'selected' : '' }}>Ordinario</option>
                    </select>
                </div>

                <div class="md:col-span-3 flex justify-center mt-2">
                    <button type="submit" class="bg-blue-900 text-white px-8 py-2 rounded-md hover:bg-blue-800 transition font-semibold shadow-lg">
                        Filtrar Resultados
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        
        @if($examenes->isEmpty())
            <div class="text-center py-10">
                <p class="text-gray-500 text-lg">No se encontraron exámenes con estos filtros.</p>
            </div>
        @else
            @php
                // Agrupamos la colección actual por Nombre de Materia
                $examenesPorMateria = $examenes->groupBy(function($item) {
                    return $item->grupo->materia->nombre;
                });
            @endphp

            @foreach($examenesPorMateria as $nombreMateria => $listaExamenes)
                <div class="mb-8 bg-white rounded-lg overflow-hidden border border-gray-200 card-shadow">
                    
                    <div class="bg-blue-900 px-6 py-3 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-white materia-title flex justify-between items-center">
                            {{ $nombreMateria }}
                            <span class="text-xs bg-blue-700 text-white px-2 py-1 rounded">
                                {{ $listaExamenes->first()->grupo->materia->codigo }}
                            </span>
                        </h3>
                    </div>

                    <div class="p-0">
                        <table class="w-full text-left border-collapse">
                            <tbody>
                                @foreach($listaExamenes as $examen)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition last:border-0">
                                        <td class="p-4 w-1/4">
                                            <span class="block text-xs text-gray-500 uppercase font-bold">Grupo</span>
                                            <span class="text-lg font-bold text-gray-800">{{ $examen->grupo->nombre }}</span>
                                        </td>
                                        
                                        <td class="p-4 w-1/3">
                                            <span class="block text-xs text-gray-500 uppercase font-bold">Docente</span>
                                            <span class="text-sm text-gray-700">{{ $examen->grupo->profesor->nombre_completo }}</span>
                                        </td>

                                        <td class="p-4">
                                            <span class="block text-xs text-gray-500 uppercase font-bold">
                                                {{ $examen->tipo->label() }}
                                            </span>
                                            <div class="flex items-center gap-2 mt-1">
                                                <span class="text-blue-900 font-bold text-md">
                                                    {{ $examen->fecha_hora->format('d/m/Y') }}
                                                </span>
                                                <span class="text-gray-600 text-sm">
                                                    {{ $examen->fecha_hora->format('h:i A') }}
                                                </span>
                                            </div>
                                            <div class="mt-1">
                                                <span class="text-xs font-semibold bg-gray-200 text-gray-700 px-2 py-0.5 rounded">
                                                    📍 Salón: {{ $examen->salon?->nombre ?? 'Por asignar' }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

            <div class="mt-8">
                {{ $examenes->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

@endsection

@push('scripts')
    @endpush