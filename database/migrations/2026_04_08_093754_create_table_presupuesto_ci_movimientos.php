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
        Schema::create('presupuesto_ci_movimientos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_presupuesto_ci');
            $table->foreign('id_presupuesto_ci')->references('id')->on('presupuesto_ci')->cascadeOnDelete();

            $table->string('mes');
            $table->decimal('importe',11,2);
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
        Schema::dropIfExists('presupuesto_ci_movimientos');
    }
};
