<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PeriodoAcademico>
 */
class PeriodoAcademicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Truco para generar fechas coherentes (inicio < fin)
        $inicio = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $fin = Carbon::instance($inicio)->addMonths(6);

        return [
            'nombre' => 'Semestre ' . $this->faker->unique()->word,
            'fecha_inicio' => $inicio,
            'fecha_fin' => $fin,
            'estatus' => false, // Por defecto inactivos para no causar conflictos
        ];
    }
}
