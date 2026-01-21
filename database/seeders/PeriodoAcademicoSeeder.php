<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PeriodoAcademico;

class PeriodoAcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Periodo Pasado (Inactivo)
        PeriodoAcademico::firstOrCreate(
            ['nombre' => 'Enero - Junio 2025'],
            [
                'fecha_inicio' => '2025-01-20',
                'fecha_fin' => '2025-06-30',
                'estatus' => false,
            ]
        );

        // 2. Periodo ACTUAL (Activo)
        // Este es el que usará el sistema por defecto
        PeriodoAcademico::firstOrCreate(
            ['nombre' => 'Agosto - Diciembre 2025'],
            [
                'fecha_inicio' => '2025-08-04',
                'fecha_fin' => '2025-12-20',
                'estatus' => true, 
            ]
        );

        // 3. Periodo Futuro (Inactivo)
        PeriodoAcademico::firstOrCreate(
            ['nombre' => 'Enero - Junio 2026'],
            [
                'fecha_inicio' => '2026-01-19',
                'fecha_fin' => '2026-06-26',
                'estatus' => false,
            ]
        );
    }
}
