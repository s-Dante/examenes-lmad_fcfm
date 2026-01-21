<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProgramaAcademico;
use App\Models\Dependencia;

class ProgramaAcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fcfm = Dependencia::where('abreviatura', 'FCFM')->first();

        if (! $fcfm) {
            $this->command->error('Error: No se encontró la dependencia FCFM. Ejecuta DependenciaSeeder primero.');
            return;
        }

        $carreras = [
            ['LMAD', 'Licenciado en Multimedia y Animación Digital'],
            ['LCC', 'Licenciado en Ciencias Computacionales'],
            ['LSTI', 'Licenciado en Seguridad en Tecnologías de Información'],
            ['LA', 'Licenciado en Actuaría'],
            ['LF', 'Licenciado en Física'],
            ['LM', 'Licenciado en Matemáticas'],
        ];

        foreach ($carreras as $carrera) {
            ProgramaAcademico::firstOrCreate(
                [
                    'abreviatura' => $carrera[0],
                    'dependencia_id' => $fcfm->id
                ],
                [
                    'nombre' => $carrera[1],
                    'descripcion' => 'Carrera oficial de la FCFM',
                    'estatus' => true,
                ]
            );
        }
    }
}
