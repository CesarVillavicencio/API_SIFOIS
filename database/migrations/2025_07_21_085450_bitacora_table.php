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
        Schema::create('bitacora', function (Blueprint $table) {
            $table->id();   
            $table->string('usuario');
            $table->string('descripcion');
            $table->unsignedBigInteger('morphable_id');
            $table->string('morphable_type');

            // $table->unsignedBigInteger('id_presupuesto');
            // $table->foreign('id_presupuesto')->references('id')->on('presupuestos');         
               
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('bitacora');
    }
};
