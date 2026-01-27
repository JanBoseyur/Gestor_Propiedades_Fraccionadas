<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('selections', function (Blueprint $table) {
            $table->id();

            // Propiedad asociada
            $table->foreignId('propiedad_id')
                  ->constrained('propiedades')
                  ->cascadeOnDelete();

            // Socio / usuario
            $table->foreignId('id_usuario')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Año de la selección
            $table->year('anio');

            // Semanas seleccionadas (JSON)
            $table->json('semana');

            $table->timestamps();

            // Evita duplicados por socio + propiedad + año
            $table->unique(['propiedad_id', 'id_usuario', 'anio']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('selections');
    }
};

