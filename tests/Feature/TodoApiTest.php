<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_a_todo()
    {
        $response = $this->postJson('/api/todos', [
            'title' => 'Learn Feature Testing',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'todo' => [
                    'title' => 'Learn Feature Testing',
                    'completed' => false,
                ],
            ]);

        $this->assertDatabaseHas('todos', [
            'title' => 'Learn Feature Testing',
        ]);
    }

    public function test_requires_a_title_when_creating_todo()
    {
        $response = $this->postJson('/api/todos', []);

        $response->assertStatus(422); // Laravel returns 422 for validation errors
        $response->assertJsonValidationErrors(['title']);
    }


    public function test_lists_todos()
    {

        $response = $this->getJson('/api/todos');
        $response->assertStatus(200);

    }
}
