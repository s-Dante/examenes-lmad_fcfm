<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Enums\RolDeUsuario;
use App\Models\ProgramaAcademico;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. EL SUPER ADMIN (TÚ)
        // Este usuario siempre debe existir.
        User::firstOrCreate(
            ['email' => 'admin@uanl.mx'],
            [
                'name' => 'SystemAdmin',
                'nombre' => 'Administrador',
                'apellido_paterno' => 'Sistema',
                'password' => 'admin123', // El cast 'hashed' del modelo lo encriptará solo? NO, en firstOrCreate mejor aseguramos string o hash manual si usamos array raw.
                // Corrección técnica: El cast 'hashed' funciona al setear el atributo. 
                // Pero para ser explícitos y seguros en seeders:
                'password' => 'admin123', 
                'rol' => RolDeUsuario::ADMIN,
                'estatus' => true,
                'carrera_id' => null,
            ]
        );

        // 2. COORDINADOR DE LMAD (Usuario Clave)
        $lmad = ProgramaAcademico::where('abreviatura', 'LMAD')->first();

        if ($lmad) {
            User::firstOrCreate(
                ['email' => 'coordinador.lmad@uanl.mx'],
                [
                    'name' => 'Coordinador LMAD',
                    'nombre' => 'Coordinador',
                    'apellido_paterno' => 'LMAD',
                    'password' => 'lmad123',
                    'rol' => RolDeUsuario::COORDINADOR,
                    'estatus' => true,
                    'carrera_id' => $lmad->id,
                ]
            );
        }

        // 3. Usuarios de Relleno (Solo en local)
        if (app()->isLocal()) {
            User::factory(5)->create();
        }
    }
}
