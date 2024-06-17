<?php

namespace Database\Factories\Blog;

use App\Models\AdminUser;
use App\Models\Blog\Post;
use App\Models\Blog\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use PhotosFake;

class PostFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        // Date
        $datetime = $this->faker->dateTimeBetween($startDate = '-60 days', $endDate = 'now', $timezone = env('APP_TIMEZONE'));
        $strtime = date_format($datetime, 'Y-m-d');
        $format_date = date('Y-m-d', strtotime($strtime));

        // Image
        $image = $this->faker->randomElement(PhotosFake::getDefaultPosts());

        return [
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'date' => $format_date,
            'description' => $this->faker->paragraph($nbSentences = 2, $variableNbSentences = true),
            'content' => $this->faker->text($maxNbChars = 800),
            'author' => $this->faker->name,
            'image' => $image,
            'thumb' => $image,
            'visits' => $this->faker->numberBetween(50, 9950),
            'slugurl' => $this->faker->slug,
            'publish' => 1,
            'tags' => ['tag1', 'tag2', 'tag3'],
            'id_category' => Category::inRandomOrder()->first()->id,
            'id_admin_user' => AdminUser::inRandomOrder()->first()->id,
        ];
    }
}
