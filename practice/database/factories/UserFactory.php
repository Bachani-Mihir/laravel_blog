<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween(0, 11),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(Str::random(3)), // password
            'remember_token' => Str::random(10),
            'role' => 'user',
        ];

        /*  return [
             'user_id' => 11,
             'name' => "mihir",
             'email' => "mihir@gmail.com",
             'email_verified_at' => now(),
             'password' => "mihir", // password
             'remember_token' => Str::random(10)
         ]; */
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
