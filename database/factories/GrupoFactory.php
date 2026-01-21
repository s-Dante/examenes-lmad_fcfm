<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Materia;
use App\Models\PeriodoAcademico;
use App\Models\Profesor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grupo>
 */
class GrupoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => (string) $this->faker->numberBetween(1, 100), // Grupos "001", "050"
            'estatus' => true,

            'materia_id' => Materia::factory(),
            'periodo_academico_id' => PeriodoAcademico::factory(),
            
            'profesor_id' => Profesor::factory(), 
        ];
    }
}
