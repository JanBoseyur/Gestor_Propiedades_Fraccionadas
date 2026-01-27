<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gastos_comunes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propiedad_id')->constrained('propiedades');
            $table->foreignId('usuario_id')->constrained('users'); 
            $table->smallInteger('anio')->unsigned();
            $table->tinyInteger('mes')->unsigned();
            $table->integer('semana')->nullable(); 
            $table->decimal('monto', 10, 2);
            $table->enum('estado', ['pendiente','pagado'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gastos_comunes');
    }
};
