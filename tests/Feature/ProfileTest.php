<?php

namespace Tests\Feature;

use App\Models\Todolist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{

    use RefreshDatabase;

    public function testProfile()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);
        Todolist::factory()->create(['user_id' => $user->id]);
        $this->get('/api/profile/' . $user->id)
            ->assertStatus(200);
    }

    public function testNotAccessProfile()
    {

        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user);

        Todolist::factory()->create(['user_id' => $user->id]);

        $this->get('/api/profile/' . $user->id)
            ->assertStatus(403);
    }
}
