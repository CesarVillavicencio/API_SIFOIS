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
        Schema::create('carta_instruccion', function (Blueprint $table) {
            $table->id();

            $table->integer('ci');
            // Partidas
            $table->unsignedBigInteger('id_partida');
            $table->foreign('id_partida')->references('id')->on('partidas');
            // Beneficiarios
            $table->unsignedBigInteger('id_beneficiario');
            $table->foreign('id_beneficiario')->references('id')->on('beneficiarios');
            // Municipios
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')->references('id')->on('municipios');

            $table->string('estatus')->default('aprobado');
            $table->string('tipo_cambio');
            $table->decimal('importe',9,2);
            $table->text('concepto');
            $table->text('observaciones');
            $table->date('fecha');

            $table->string('creado_por');
            $table->string('actualizado_por')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carta_instruccion');
    }
};
