<?php

namespace Tests\Feature;

use App\Models\Todolist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    private $bas_url = "/api/todolists/";

    public function testCreateTodoList()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $payload = [
            'title' => "title test",
            'description' => "description test"
        ];

        $this->post("/api/todolists", $payload)
            ->assertStatus(200)
            ->assertSee('title test')
            ->assertSee('description test');

        $todolist = Todolist::where('title', $payload['title'])
            ->where('description', $payload['description'])
            ->count();

        $this->assertEquals(1, $todolist);
    }

    public function testShowTodoLists()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $todolist = Todolist::factory()->create();

        $this->get($this->bas_url . $todolist->id)
            ->assertStatus(200)
            ->assertSee($todolist->title);
    }

    public function testIndexTodolists()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Todolist::factory()->count(3)->create();

        $this->get($this->bas_url)
            ->assertJsonCount(3, 'data')
            ->assertStatus(200);
    }

    public function testUpdateTodolists()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $todolist = Todolist::factory()->create();

        $payload = [
            'title' => 'new test title',
            'description' => 'new description test'
        ];

        $this->patch($this->bas_url . $todolist->id, $payload)
            ->assertStatus(201);

        $this->assertDatabaseHas('todolists', ['title' => $payload['title']]);
    }

    public function testDeleteTodolists()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $todolist = Todolist::factory()->create();

        $this->delete($this->bas_url . $todolist->id)
            ->assertStatus(204);


        $this->assertEquals(0, Todolist::count());
    }

}
