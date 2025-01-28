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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_comprador')->nullable();
            $table->foreign('id_comprador')->references('id')->on('compradores')->onDelete('cascade');
            $table->decimal('precio_total', 10, 2);
            $table->enum('estado', ['PENDIENTE', 'ENVIADA'])->default('PENDIENTE');
            $table->dateTime('fecha_compra')->useCurrent();
            $table->dateTime('fecha_envio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
