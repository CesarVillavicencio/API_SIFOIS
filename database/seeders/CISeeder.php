<?php

namespace Database\Seeders;

use App\Models\CartaInstruccion;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CISeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $this->call([
            EntidadesTableSeeder::class,
            MunicipiosTableSeeder::class,
            BeneficiarioSeeder::class,
            PartidasSeeder::class,
        ]);

        // $cartas = CartaInstruccion::factory(1000)->create();

        // foreach ($cartas as $carta) {
        //     $year = Carbon::parse($carta->fecha)->format('Y');

        //     if (!isset($carta_year[$year])) {
        //         $carta_year[$year] = 1;
        //     } else {
        //         $carta_year[$year]++;
        //     }

        //     $carta->ci = $carta_year[$year];
        //     $carta->save();
        // }
    }
}
