<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropActivadoFromProductosTable extends Migration
{
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            // Elimina la columna 'activado'
            $table->dropColumn('activado');
        });
    }

    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            // Si es necesario, vuelve a agregar la columna 'activado'
            $table->boolean('activado')->default(0)->after('imagen');
        });
    }
}
