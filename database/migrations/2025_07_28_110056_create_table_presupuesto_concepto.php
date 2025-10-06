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
        Schema::create('presupuesto_concepto', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_presupuesto');
            $table->foreign('id_presupuesto')->references('id')->on('presupuestos')->cascadeOnDelete();

            $table->string('concepto');

            $table->decimal('importe',11,2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presupuesto_concepto');
    }
};
