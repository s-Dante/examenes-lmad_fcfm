<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Dependencia;

class DependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear FCFM (Siempre debe existir)
        Dependencia::firstOrCreate(
            ['abreviatura' => 'FCFM'], // Busca por esto
            [
                'nombre' => 'Facultad de Ciencias Físico Matemáticas',
                'direccion' => 'Av. Universidad s/n, Cd. Universitaria',
                'telefono' => '8183294000',
                'email' => 'contacto@fcfm.uanl.mx',
                'estatus' => true,
            ]
        );

        // Si estamos en local, crear datos basura extra para probar paginación
        /*
        if (app()->isLocal()) {
            Dependencia::factory(5)->create();
        }
        */
    }
}
