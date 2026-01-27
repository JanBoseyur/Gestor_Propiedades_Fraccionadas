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
            'n_socios' => 2,
            'fotos' => json_encode([
                'fotos/casa1_1.jpg',
                'fotos/casa1_2.jpg',
                'fotos/casa1_3.jpg'
            ]),
            'amenidades' => json_encode([
                'Piscina',
                'Jardín',
                'Estacionamiento'
            ]),
        ]);

        // Ejemplo 2
        Propiedades::create([
            'nombre' => 'Departamento Centro',
            'ubicacion' => 'Santiago Centro',
            'descripcion' => 'Departamento moderno cerca del metro',
            'n_socios' => 1,
            'fotos' => json_encode([
                'fotos/depto1_1.jpg',
                'fotos/depto1_2.jpg'
            ]),
            'amenidades' => json_encode([
                'Ascensor',
                'WiFi',
                'Seguridad 24h'
            ]),
        ]);

        // Ejemplo 3
        Propiedades::create([
            'nombre' => 'Cabaña en la montaña',
            'ubicacion' => 'Valle Nevado',
            'descripcion' => 'Cabaña acogedora rodeada de naturaleza',
            'n_socios' => 4,
            'fotos' => json_encode([
                'fotos/cabana1_1.jpg',
                'fotos/cabana1_2.jpg'
            ]),
            'amenidades' => json_encode([
                'Chimenea',
                'Barbacoa',
                'Senderos'
            ]),
        ]);
    }
}
