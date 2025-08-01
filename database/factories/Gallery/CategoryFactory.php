<?php

namespace Database\Factories\Gallery;

use App\Models\Gallery\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'name' => $this->faker->word,
            'count_photos' => 30,
        ];
    }
}
