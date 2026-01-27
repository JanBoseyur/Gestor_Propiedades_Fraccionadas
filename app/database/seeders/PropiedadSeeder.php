<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Propiedades;

class PropiedadSeeder extends Seeder
{
    public function run()
    {
        Propiedades::create([
            'nombre' => 'Villa Coralina',
            'ubicacion' => 'Punta Cana, Dominican Republic',
            'descripcion' => 'Una lujosa villa frente al mar con acceso directo a la playa. Perfecta para familias y grupos grandes que buscan una escapada tropical inolvidable.',
            'fotos' => [
                'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=2070&auto=format&fit=crop'
            ],
            'amenidades' => ['Piscina', 'Acceso a la Playa', 'Aire Acondicionado', 'Seguridad 24/7', 'WiFi'], 
        ]);

        Propiedades::create([
            'nombre' => 'Hacienda del Mar',
            'ubicacion' => 'Punta Cana, Dominican Republic',
            'descripcion' => 'Encantadora hacienda con vistas al mar Caribe. Disfruta de la tranquilidad y el lujo en un entorno natural espectacular.',
            'fotos' => [
                'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?q=80&w=1949&auto=format&fit=crop',
            ],
            'amenidades' => ['Piscina', 'Gimnasio', 'Spa', 'Restaurante'], 
        ]);

        Propiedades::create([
            'nombre' => 'Residencia Palma Real',
            'ubicacion' => 'Punta Cana, Dominican Republic',
            'descripcion' => 'Moderna residencia con todas las comodidades. Ubicada en un exclusivo complejo con campo de golf y club de playa.',
            'fotos' => [
                'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?q=80&w=1974&auto=format&fit=crop',
            ],
            'amenidades' => ['Campo de Golf', 'Acceso a la Playa', 'Cancha de Tenis', 'Seguridad 24/7'], 
        ]);
    }
}
