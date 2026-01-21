<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PeriodoAcademico;
use App\Models\Profesor;
use App\Models\Materia;
use App\Models\Grupo;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtener datos necesarios
        // Usamos el periodo actual que creamos en PeriodoAcademicoSeeder
        $periodoActual = PeriodoAcademico::where('nombre', 'Agosto - Diciembre 2025')->first();
        
        if (!$periodoActual) {
            $this->command->warn('No se encontró el periodo actual. Corre PeriodoAcademicoSeeder primero.');
            return;
        }

        // Obtener un profesor y una materia cualquiera
        $profesor = Profesor::where('numero_empleado', '!=', '000000')->first() ?? Profesor::factory()->create();
        $materia = Materia::first() ?? Materia::factory()->create();

        // 2. Crear Grupos de Prueba
        // Grupo 001
        Grupo::firstOrCreate(
            [
                'nombre' => '001',
                'materia_id' => $materia->id,
                'periodo_academico_id' => $periodoActual->id,
            ],
            [
                'profesor_id' => $profesor->id,
                'estatus' => true,
            ]
        );

        // Grupo 002
        Grupo::firstOrCreate(
            [
                'nombre' => '002',
                'materia_id' => $materia->id,
                'periodo_academico_id' => $periodoActual->id,
            ],
            [
                'profesor_id' => $profesor->id, // Puede ser el mismo profe
                'estatus' => true,
            ]
        );
    }
}
