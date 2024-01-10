<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
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

    public function test_user_login_with_valid_credentials()
    {
        $credentials = [
            'email' => 'mihir@gmail.com',
            'password' => 'mihir',
        ];

        $response = $this->postJson('/api/login', $credentials);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'token',
                'role',
            ]);

        $this->assertAuthenticated(); // Ensure user is authenticated
    }

    public function test_user_login_with_invalid_credentials()
    {
        $invalidCredentials = [
            'email' => 'mihir@gmail.com',
            'password' => 'Mihir',
        ];

        $response = $this->postJson('/api/login', $invalidCredentials);

        $response->assertStatus(302) // Assuming you are redirecting back on invalid credentials
            ->assertSessionHasErrors(['password']);

        $this->assertGuest(); // Ensure user is not authenticated
    }
}
