<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);

        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password123'), 
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Sebastian',
            'email' => 'seba@gmail.com',
            'password' => bcrypt('seba123'), 
        ]);
        $user->assignRole('user');

        $this->call([
            PropiedadSeeder::class,
            SemanasSeeder::class,
            AniosSeeder::class,
        ]);
    }
}
