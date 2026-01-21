<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProgramaAcademico;
use App\Models\PlanAcademico;
use App\Models\Materia;


class PlanAcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lmad = ProgramaAcademico::where('abreviatura', 'LMAD')->first();

        if (! $lmad) {
            $this->command->warn('No se encontró LMAD. Asegúrate de correr ProgramaAcademicoSeeder antes.');
            return;
        }

        // 1. CREAR PLAN
        $plan420 = PlanAcademico::firstOrCreate(
            ['codigo' => '420'],
            [
                'nombre' => 'Plan de Estudios 420 (2020)',
                
                // CORRECCIÓN CRÍTICA: El nombre debe coincidir EXACTO con la BD
                'programa_academico_id' => $lmad->id, 
                
                'estatus' => true
            ]
        );

        // 2. CREAR MATERIAS
        $materiasData = [
            ['nombre' => 'Cálculo Diferencial', 'codigo' => 'MC-101'],
            ['nombre' => 'Programación Estructurada', 'codigo' => 'LMAD-101'],
            ['nombre' => 'Física I', 'codigo' => 'FC-101'],
            ['nombre' => 'Competencia Comunicativa', 'codigo' => 'FG-101'],
        ];

        foreach ($materiasData as $data) {
            $materia = Materia::firstOrCreate(
                ['codigo' => $data['codigo']],
                ['nombre' => $data['nombre'], 'estatus' => true]
            );

            // 3. ASOCIAR (PIVOTE)
            // Esto ahora funcionará porque cambiamos a BelongsToMany en el modelo
            $plan420->materias()->syncWithoutDetaching([
                $materia->id => [
                    'semestre' => 1,
                    'creditos' => rand(3, 5)
                ]
            ]);
        }
    }
}
