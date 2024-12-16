<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SepomexSeeder extends Seeder {
    public function run() {
        $this->call([
            EntidadesTableSeeder::class,
            MunicipiosTableSeeder::class,
        ]);
    }
}
