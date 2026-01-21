<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Dependencia;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProgramaAcademico>
 */
class ProgramaAcademicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->jobTitle(),
            'abreviatura' => strtoupper($this->faker->lexify('????')),
            'descripcion' => $this->faker->sentence(),
            'estatus' => true,
            'dependencia_id' => Dependencia::factory(),
        ];
    }
}
