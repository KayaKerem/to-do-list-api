<?php

namespace Tests\Feature;

use App\Models\Todolist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QueryFilterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testIsAdmın(){
        $user= User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        User::factory()->count(5)->create(['is_admin' => true]);
        $response = $this->get('/api/user?is_admin=1')
            ->assertStatus(200)->assertJsonCount(1);

    }

    public function testSearchQuery(){
        $user= User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        Todolist::factory()->count(50)->create();
        Todolist::factory()->create(['title'=>'Test']);

        $this->get('/api/todolists?search=Test')->assertStatus(200)
            ->assertJsonCount(1);
    }
}
