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
        Schema::create('presupuesto_ajuste', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_presupuesto_partida');
            $table->foreign('id_presupuesto_partida')->references('id')->on('presupuesto_partidas')->cascadeOnDelete();

            $table->enum('tipo', ['incremento', 'disminucion']);
            $table->decimal('importe',11,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presupuesto_ajuste');
    }
};
