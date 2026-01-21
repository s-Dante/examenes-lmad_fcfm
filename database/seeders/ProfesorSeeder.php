<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Profesor;

class ProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profesor::firstOrCreate(
            ['numero_empleado' => '000000'],
            [
                'nombre' => 'Administrador',
                'apellido_paterno' => 'Examenes',
                'apellido_materno' => 'FCFM',
                'correo_electronico' => 'admin@fcfm.edu.mx',
                'estatus' => true,
            ]
        );

        
        if (app()->isLocal()) {
            Profesor::factory(10)->create();
        }
    }
}
