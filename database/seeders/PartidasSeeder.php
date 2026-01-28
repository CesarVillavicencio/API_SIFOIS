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
            'nombre'    => 'PROMOCIÓN NACIONAL',
            'padre_id'  => null,
            'creado_por' => 'CVILLAVICENCIO'
        ]);

        Partida::create([
            'nombre'    => 'PROMOCIÓN INTERNACIONAL',
            'padre_id'  => null,
            'creado_por' => 'CVILLAVICENCIO'
        ]);

        Partida::create([
            'nombre'    => 'PROGRAMAS ESPECIALES',
            'padre_id'  => null,
            'creado_por' => 'CVILLAVICENCIO'
        ]);

         Partida::create([
            'nombre'    => 'PRESENCIAS BCS',
            'padre_id'  => 1,
            'creado_por' => 'CVILLAVICENCIO'
        ]);

        Partida::create([
            'nombre'    => 'APOYOS Y PATROCINIOS ',
            'padre_id'  => 1,
            'creado_por' => 'CVILLAVICENCIO'
        ]);

        Partida::create([
            'nombre'    => 'MATERIAL DE PROMOCION',
            'padre_id'  => 1,
            'creado_por' => 'CVILLAVICENCIO'
        ]);

        // Partida::create([
        //     'nombre'    => 'Tianguis Turistico',
        //     'padre_id'  => 1,
        //     'creado_por' => 'CVILLAVICENCIO'
        // ]);

        // Partida::create([
        //     'nombre'    => 'ATMEX',
        //     'padre_id'  => 1,
        //     'creado_por' => 'CVILLAVICENCIO'
        // ]);

        // Partida::create([
        //     'nombre'    => 'Apoyo a Fams Trips en Comondú',
        //     'padre_id'  => 2,
        //     'creado_por' => 'CVILLAVICENCIO'
        // ]);

        // Partida::create([
        //     'nombre'    => 'Apoyo a Fams Trips en Mulege',
        //     'padre_id'  => 2,
        //     'creado_por' => 'CVILLAVICENCIO'
        // ]);


        // Partida::create([
        //     'nombre'    => 'Comondú',
        //     'padre_id'  => 3,
        //     'creado_por' => 'CVILLAVICENCIO'
        // ]);

        // Partida::create([
        //     'nombre'    => 'Mulegé',
        //     'padre_id'  => 2,
        //     'creado_por' => 'CVILLAVICENCIO'
        // ]);

        // Partida::create([
        //     'nombre'    => 'Materiales Promocionales y Colaterales',
        //     'padre_id'  => 3,
        //     'creado_por' => 'CVILLAVICENCIO'
        // ]);
       
    }
}