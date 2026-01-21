<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Enums\TipoExamen;
use App\Models\Grupo;
use App\Models\Salon;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Examen>
 */
class ExamenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo' => $this->faker->randomElement(TipoExamen::cases()),
            
            'fecha_hora' => $this->faker->dateTimeBetween('now', '+1 month'),
            
            'estatus' => true,
            
            'grupo_id' => Grupo::factory(),
            'salon_id' => Salon::factory(),
            'creado_por_id' => User::factory(),
        ];
    }
}
