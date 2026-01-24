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
            
            // Columna que referencia a propiedades.id
            $table->unsignedBigInteger('propiedad_id');
            
            $table->decimal('monto', 10, 2);
            $table->string('descripcion')->nullable();
            $table->date('fecha_pago')->nullable();
            $table->boolean('pagado')->default(false);

            $table->timestamps();

            // Clave foránea con nombre único
            $table->foreign('propiedad_id', 'fk_gastos_propiedad')
                  ->references('id')->on('propiedades')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gastos_comunes');
    }
};
