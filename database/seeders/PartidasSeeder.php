<?php

namespace Database\Seeders;

use App\Models\Partida;
use Illuminate\Database\Seeder;

class PartidasSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // Partida::insert([
        //     [
        //         'nombre' => 'PROMOCIÓN_Y_PUBLICIDAD_NACIONAL',
        //         'padre_id' => null,
        //     ],
        //     [
        //         'nombre' => 'PROMOCIÓN_Y_PUBLICIDAD_INTERNACIONAL',
        //         'padre_id' => null,
        //     ],
        //     // etc...
        // ]);

        // Partida::factory(3)
        //     ->create();
        // }

    // public function run() {
        Partida::create([
            'nombre'    => 'PROMOCIÓN_Y_PUBLICIDAD_NACIONAL',
            'padre_id'  => null,
        ]);

        Partida::create([
            'nombre'    => 'PROMOCIÓN_Y_PUBLICIDAD_INTERNACIONAL',
            'padre_id'  => null,
        ]);

        Partida::create([
            'nombre'    => 'MATERIALES_PROMOCIONALES',
            'padre_id'  => null,
        ]);

        Partida::create([
            'nombre'    => 'Relaciones_públicas_y_medios',
            'padre_id'  => 1,
        ]);

        Partida::create([
            'nombre'    => 'Diseño_de_materiales_y_desarrollo_de_contenido',
            'padre_id'  => 1,
        ]);

        Partida::create([
            'nombre'    => 'Relaciones_públicas_y_medios',
            'padre_id'  => 1,
        ]);

        Partida::create([
            'nombre'    => 'Diseño_de_materiales_y_desarrollo_de_contenido',
            'padre_id'  => 1,
        ]);

        Partida::create([
            'nombre'    => 'Relaciones_Públicas_y_Medios_Estados_Unidos',
            'padre_id'  => 2,
        ]);

        Partida::create([
            'nombre'    => 'Relaciones_Públicas_y_Medios_Canadá',
            'padre_id'  => 2,
        ]);

        Partida::create([
            'nombre'    => 'Materiales Promocionales y Colaterales',
            'padre_id'  => 3,
        ]);
       
    }
}