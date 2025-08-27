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
        Schema::create('presupuesto_ci', function (Blueprint $table) {
            $table->id();  
            $table->integer('ci');
            //Presupuestos
            $table->unsignedBigInteger('id_presupuesto');
            $table->foreign('id_presupuesto')->references('id')->on('presupuestos');
            // Partidas
            $table->unsignedBigInteger('id_partida');
            $table->foreign('id_partida')->references('id')->on('partidas');
            // Beneficiarios
            $table->unsignedBigInteger('id_beneficiario');
            $table->foreign('id_beneficiario')->references('id')->on('beneficiarios')->nullable();
            // Municipios
            // $table->json('id_municipio');

            
            $table->string('tipo_cambio');
            $table->decimal('presupuestado',9,2);
            $table->json('importe_meses')->nullable();
            $table->decimal('importe', 9,2);
            $table->text('concepto');
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('presupuesto_ci');
    }

    public function getMonthsValue(){
        return [
            'enero' => 0.00,
            'febrero' => 0.00,
            'marzo' => 0.00,
            'abril' => 0.00,
            'mayo' => 0.00,
            'junio' => 0.00,
            'julio' => 0.00,
            'agosto' => 0.00,
            'septiembre' => 0.00,
            'octubre' => 0.00,
            'noviembre' => 0.00,
            'diciembre' => 0.00
        ];
    }
};
