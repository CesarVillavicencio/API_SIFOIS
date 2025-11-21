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
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_fideicomiso');
            $table->foreign('id_fideicomiso')->references('id')->on('fideicomisos')->after('id');

            $table->string('periodo');
            $table->string('year');
            
            $table->json('id_municipio');
            
            $table->string('estatus')->default('aprobado');
            
            $table->string('tipo_cambio')->default('MXN');
            $table->float('valor_cambio')->default(1);

            $table->string('creado_por');
            $table->string('actualizado_por')->nullable();

            $table->string('serie')->nullable();
            $table->date('fecha');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presupuestos');
    }
};
