<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salon>
 */
class SalonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Genera nombres tipo "A4-101", "Lab-02"
            'nombre' => $this->faker->unique()->bothify('A?-###'), 
            'capacidad' => $this->faker->numberBetween(20, 50),
            'estatus' => true,
        ];
    }
}
