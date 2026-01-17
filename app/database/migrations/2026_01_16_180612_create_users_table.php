<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();                     // id autoincremental
            $table->string('name');           // nombre del usuario
            $table->string('email')->unique(); // correo único
            $table->string('password');       // contraseña hasheada
            $table->timestamps();             // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
