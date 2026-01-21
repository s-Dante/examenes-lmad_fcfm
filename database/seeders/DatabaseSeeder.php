<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Modelos
use App\Models\Dependencia;
use App\Models\ProgramaAcademico;
use App\Models\PlanAcademico;
use App\Models\Materia;
use App\Models\User;
use App\Models\PeriodoAcademico;
use App\Models\Profesor;
use App\Models\Salon;
use App\Models\Grupo;
use App\Models\Examen;

//Facotries
use Database\Factories\DependenciaFactory;
use Database\Factories\ProgramaAcademicoFactory;
use Database\Factories\PlanAcademicoFactory;
use Database\Factories\MateriaFactory;
use Database\Factories\UserFactory;
use Database\Factories\PeriodoAcademicoFactory;
use Database\Factories\ProfesorFactory;
use Database\Factories\SalonFactory;
use Database\Factories\GrupoFactory;
use Database\Factories\ExamenFactory;

//Seeders
use Database\Seeders\DependenciaSeeder;
use Database\Seeders\ProgramaAcademicoSeeder;
use Database\Seeders\PlanAcademicoSeeder;
use Database\Seeders\MateriaSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PeriodoAcademicoSeeder;
use Database\Seeders\ProfesorSeeder;
use Database\Seeders\SalonSeeder;
use Database\Seeders\GrupoSeeder;
use Database\Seeders\ExamenSeeder;
use GMP;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            //Bloque Organizacional
            DependenciaSeeder::class,
            ProgramaAcademicoSeeder::class,

            //Bloque Academico
            PlanAcademicoSeeder::class,
            MateriaSeeder::class,
            
            //Bloque Logistica
            PeriodoAcademicoSeeder::class,
            SalonSeeder::class,
            ProfesorSeeder::class,

            //Bloque de Carga Academica
            GrupoSeeder::class,

            //Bloque de examenes
            UserSeeder::class,
            
            //Examenes
            ExamenSeeder::class,
        ]);
    }
}
