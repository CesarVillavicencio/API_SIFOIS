<?php

namespace Database\Seeders;

use AdminHelpers;
use App\Models\AdminUser;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Reset All Admin Configuration to default values
        AdminHelpers::resetAdminConfig();

        // Admin Users
        AdminUser::factory(50)->create();
    }
}
