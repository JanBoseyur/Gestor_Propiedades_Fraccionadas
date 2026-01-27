<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Propiedades;

class PropiedadSeeder extends Seeder
{
    public function run()
    {
        // Ejemplo 1
        Propiedades::create([
            'nombre' => 'Casa Vista al Mar',
            'ubicacion' => 'Viña del Mar',
            'descripcion' => 'Hermosa casa con vista al mar y piscina',
            'fotos' => json_encode([
                'fotos/casa1_1.jpg',
            ]),
            'amenidades' => json_encode([
                'Piscina',
                'Jardín',
                'Estacionamiento'
            ]),
        ]);

        Propiedades::create([
            'nombre' => 'Departamento Centro',
            'ubicacion' => 'Santiago Centro',
            'descripcion' => 'Departamento moderno cerca del metro',
            'fotos' => json_encode([
                'fotos/depto1_1.jpg',
            ]),
            'amenidades' => json_encode([
                'Ascensor',
                'WiFi',
                'Seguridad 24h'
            ]),
        ]);
    }
}
