<?php

namespace Database\Seeders;

use App\Models\Gallery\Category;
use App\Models\Gallery\Photo;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Category::factory(20)
            ->has(Photo::factory()->count(50), 'photos')
            ->create();
        }
}
