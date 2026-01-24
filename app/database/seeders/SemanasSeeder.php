<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Semana;


class SemanasSeeder extends Seeder
{

    public function run()
    {
        $anios = \App\Models\Anio::all();

        foreach ($anios as $anio) {
            for ($i = 1; $i <= 52; $i++) {
                Semana::create([
                    'anio_id' => $anio->id,
                    'numero_semana' => $i,
                    'estado' => 'disponible'
                ]);
            }
        }
    }

}
