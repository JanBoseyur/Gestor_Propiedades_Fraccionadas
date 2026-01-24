<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('gastos_comunes', function (Blueprint $table) {
            $table->smallInteger('anio')->unsigned()->after('propiedad_id');
            $table->tinyInteger('mes')->unsigned()->after('anio');
        });
    }

    public function down()
    {
        Schema::table('gastos_comunes', function (Blueprint $table) {
            $table->dropColumn(['anio', 'mes']);
        });
    }
};
