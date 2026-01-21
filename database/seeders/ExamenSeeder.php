<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Enums\TipoExamen;
use App\Models\Examen;
use App\Models\Grupo;
use App\Models\Salon;
use App\Models\User;

class ExamenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtener recursos existentes (No crear nuevos si no es necesario)
        $grupo = Grupo::where('nombre', '001')->first();
        
        // Si no hay grupo, no podemos poner examen (Lógica de negocio)
        if (!$grupo) {
            $this->command->warn('No se encontró el Grupo 001. Corre GrupoSeeder primero.');
            return;
        }

        // Obtener un salón cualquiera (o el laboratorio si es materia práctica)
        $salon = Salon::inRandomOrder()->first() ?? Salon::factory()->create();
        
        // Obtener al admin (usuario ID 1 usualmente)
        $admin = User::first() ?? User::factory()->create();

        // 2. Agendar 1er Parcial
        Examen::firstOrCreate(
            [
                'grupo_id' => $grupo->id,
                'tipo' => TipoExamen::PARCIAL_1, // Uso del Enum
            ],
            [
                'fecha_hora' => '2025-09-15 14:00:00', // Fecha fija para pruebas
                'salon_id' => $salon->id,
                'creado_por_id' => $admin->id,
                'estatus' => true,
            ]
        );
        
        $this->command->info('Examen Parcial 1 agendado para el Grupo 001.');
    }
}
