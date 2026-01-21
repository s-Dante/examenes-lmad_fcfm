<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ProgramaAcademico;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlanAcademico>
 */
class PlanAcademicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'nombre' => 'Plan ' . $this->faker->year(),
        'codigo' => (string) $this->faker->unique()->numberBetween(100, 999),
        'estatus' => true,
        'programa_academico_id' => ProgramaAcademico::factory(),
    ];
}
}
