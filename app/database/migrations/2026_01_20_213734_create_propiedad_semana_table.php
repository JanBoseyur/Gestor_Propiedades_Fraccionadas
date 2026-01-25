<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('propiedad_semana', function (Blueprint $table) {
            $table->id();

            $table->foreignId('propiedad_id')
                ->constrained('propiedades')
                ->cascadeOnDelete();

            $table->foreignId('semana_id')
                ->constrained('semanas')
                ->cascadeOnDelete();

            $table->foreignId('usuario_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['propiedad_id', 'semana_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad_semana');
    }
};
