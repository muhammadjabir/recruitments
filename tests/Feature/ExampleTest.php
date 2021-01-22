<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/register');

        $response->assertStatus(404);
    }
    public function test_middleware_cant_auth_post()
    {
        $response = $this->get('/api/todos');

        $response->assertStatus(403);
    }
    public function test_middleware_auth_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/api/todos');

        $response->assertStatus(200);
    }

    public function test_create_post() {
        $user = User::factory()->create();
        $post = Post::factory()->make();
        $this->actingAs($user);
        $response = $this->post('/api/todos',$post->toArray());
        $response->assertStatus(200);
    }
    public function test_create_post_cant_auth() {
        $post = Post::factory()->make();
        $response = $this->post('/api/todos',$post->toArray());
        $response->assertStatus(403);
    }

    public function test_update_post() {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $this->actingAs($user);
        $response = $this->put('/api/todos/' .$post->id,$post->toArray());
        $response->assertStatus(200);
    }

    public function test_update_post_cant_auth() {
        $post = Post::factory()->create();
        $response = $this->put('/api/todos/' .$post->id,$post->toArray());
        $response->assertStatus(403);
    }
    public function test_delete_post_cant_auth() {
        $post = Post::factory()->create();
        $response = $this->delete('/api/todos/' .$post->id,$post->toArray());
        $response->assertStatus(403);
    }

    public function test_delete_post() {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $this->actingAs($user);
        $response = $this->delete('/api/todos/' .$post->id,$post->toArray());
        $response->assertStatus(200);
    }

}
