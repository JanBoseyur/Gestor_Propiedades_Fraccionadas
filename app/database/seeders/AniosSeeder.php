<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anio;


class AniosSeeder extends Seeder
{
    public function run()
    {
        Anio::create(['anio' => 2025]);
        Anio::create(['anio' => 2026]);
    }

}
