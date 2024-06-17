<?php

namespace Database\Factories\Gallery;

use App\Models\AdminUser;
use App\Models\Gallery\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;
use PhotosFake;

class PhotoFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        // Image
        $image = $this->faker->randomElement(PhotosFake::getDefaultPosts());

        return [
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'description' => $this->faker->paragraph($nbSentences = 2, $variableNbSentences = true),
            'image' => $image,
            'thumb' => $image,
            'id_admin_user' => AdminUser::inRandomOrder()->first()->id,
        ];
    }
}
