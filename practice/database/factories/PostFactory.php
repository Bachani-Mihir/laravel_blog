<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
           // 'user_id' => $this->faker->unique()->numberBetween(100,999),
            'category_id' => $this->faker->numberBetween(1,9),
            'slug' => $this->faker->slug,
            'title' => $this->faker->sentence,
            'thumbnail' => $this->faker->imageUrl(640, 480),
            'excerpt' => $this->faker->paragraph,
            'body' => $this->faker->paragraph,
            'created_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'updated_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'published_at' => $this->faker->date
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    // public function unverified()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'email_verified_at' => null,
    //         ];
    //     });
    // }
}
