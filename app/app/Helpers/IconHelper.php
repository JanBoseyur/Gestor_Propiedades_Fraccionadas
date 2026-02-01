<?php
if (!function_exists('amenidadIcon')) {
    function amenidadIcon($nombre) {
        $map = [
            'Piscina' => 'fa-solid fa-water-ladder',
            'Gimnasio' => 'fa-solid fa-dumbbell',
            'Estacionamiento' => 'fa-solid fa-square-parking',
            'WiFi' => 'fa-solid fa-wifi',
            'Mascotas' => 'fa-solid fa-paw',
            'Jardín' => 'fa-solid fa-sun-plant-wilt',
            'Spa' => 'fa-solid fa-spa',
            'Lavandería' => 'fa-solid fa-soap',
            'Aire Acondicionado' => 'fa-solid fa-wind',
            'Acceso a la Playa' => 'fa-solid fa-umbrella-beach',
            'Seguridad 24/7' => 'fa-solid fa-shield',
            'Cancha de Tenis' => 'BUSCAR',
            'Campo de Golf' => 'fa-solid fa-golf-ball-tee',
        ];

        return $map[$nombre] ?? 'ri-checkbox-line';
    }
}
