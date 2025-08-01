<?php

namespace Database\Factories;

use App\Models\AdminUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use PhotosFake;

class AdminUserFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdminUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'name' => $this->faker->name,
            'lastname' => $this->faker->lastname,
            'email' => $this->faker->unique()->safeEmail,
            'type' => $this->faker->randomElement(config('admin.user_types')),
            'avatar' => $this->faker->randomElement(PhotosFake::getDefaultAdminPeople()),
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ];
    }
}
