<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $count_users = env('SEEDERS_USERS_QUANTITY', 100);

        User::factory($count_users)->create();
    }
}
