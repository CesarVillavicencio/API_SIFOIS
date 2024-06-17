<?php

namespace Database\Seeders;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Category::factory(20)
            ->has(Post::factory()->count(20), 'posts')
            ->create();
    }
}
