<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Propiedad;

class PropiedadesSeeder extends Seeder
{

    public function run()
    {
        Propiedad::create(['nombre' => 'Departamento Centro']);
        Propiedad::create(['nombre' => 'Casa Playa']);
    }

}
