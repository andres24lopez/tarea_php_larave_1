<?php

namespace Database\Seeders;

use App\Models\Puesto;
use Illuminate\Database\Seeder;

class PuestoSeeder extends Seeder
{
    public function run(): void
    {
        $puestos = [
            'Programador',
            'Analista',
            'Calidad',
        ];

        foreach ($puestos as $puesto) {
            Puesto::firstOrCreate([
                'puesto' => $puesto,
            ]);
        }
    }
}
