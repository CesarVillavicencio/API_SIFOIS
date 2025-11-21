<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fideicomisos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        DB::table('fideicomisos')->insert([
            ['nombre' => 'FITURCA'],
            ['nombre' => 'FITUES'],
            ['nombre' => 'FITUPAZ'],
            ['nombre' => 'FITUCOMUL'],
            ['nombre' => 'FITULORE'],
            ['nombre' => 'FOIS LOS CABOS'],
            ['nombre' => 'FOIS LA PAZ'],
            ['nombre' => 'FOIS COMONDU'],
            ['nombre' => 'FOIS LORETO'],
            ['nombre' => 'FOIS MULEGE'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fideicomisos');
    }
};
