<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PostControllerTest extends TestCase
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

    public function test_admin_can_update_post()
    {
        Sanctum::actingAs($admin = User::factory()->create(['role' => 'admin']));

        // Create a post for testing
        $post = Post::factory()->create(['user_id' => $admin->user_id]);

        // New data to update the post
        $updatedData = [
            'title' => 'hello mihir',
            // Add any other fields you want to update
        ];

        // Make a PATCH request to update the post
        $response = $this->patchJson("api/admin/posts/{$post->id}", $updatedData);
        // @dd($response);
        // Assert that the response is successful
        $response->assertSuccessful();

        // Reload the post from the database to check if it was updated
        $updatedPost = Post::find($post->id);

        // Assert that the post was updated with the new data
        $this->assertEquals($updatedData['title'], $updatedPost->title);
        // Add assertions for any other fields you updated
    }

    public function test_admin_can_create_post()
    {
        Sanctum::actingAs($admin = User::factory()->create(['role' => 'admin']));
        //   @dd($admin,$admin->user_id);
        $post = Post::factory()->create(['user_id' => $admin->user_id])->toArray;
        // Make a POST request to update the post
        $response = $this->postJson('api/admin/posts/create', $post);
        // Assert that the response is successful
        $response->assertSuccessful();

        $this->assertDatabaseHas('posts', [
            'slug' => $post['slug'],
        ]);
    }

    public function test_admin_can_delete_post()
    {
        Sanctum::actingAs($admin = User::factory()->create(['role' => 'admin']));
        $post = Post::factory()->create(['user_id' => $admin->user_id]);
        // Make a PATCH request to update the post
        $response = $this->deleteJson("api/admin/posts/{$post->id}");
        $response->assertSuccessful();

        $this->assertDatabaseMissing('posts', [
            'slug' => $post['slug'],
        ]);
    }
}
