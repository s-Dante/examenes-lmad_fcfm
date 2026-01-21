<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Salon;

class SalonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aulas = ['A4-101', 'A4-102', 'A4-103', 'A4-104', 'LCC-LAB1', 'LMAD-LAB1'];

        foreach ($aulas as $nombre) {
            Salon::firstOrCreate(
                ['nombre' => $nombre],
                [
                    'capacidad' => 40,
                    'estatus' => true
                ]
            );
        }

        // Rellenar con basura si es entorno local
        if (app()->isLocal()) {
            Salon::factory(10)->create();
        }
    }
}
