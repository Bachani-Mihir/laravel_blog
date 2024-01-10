<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterationTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_on_successful_registration()
    {
        $user = [
            'name' => $this->faker->unique()->name,
            'user_id' => $this->faker->unique()->numberBetween(1, 1000),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'role' => 'user',
        ];
        // Make a POST request to your registration endpoint with the factory-generated data
        $response = $this->postJson('/api/', $user);

        // Assert that the response is successful
        $response->assertSuccessful();

        // Assert that the user is logged in
        $this->assertAuthenticated();

        $response->assertJson([
            'message' => 'User Registered Successfully',
        ]);

        // Assert that a user with the provided email exists in the database
        $this->assertDatabaseHas('users', [
            'email' => $user['email'],
        ]);
    }
}
