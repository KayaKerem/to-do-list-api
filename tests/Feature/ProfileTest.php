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

    public function testGetProfilesByIsAdminFilter()
    {
        $user = User::factory()->create(['is_admin' => true]);

        $this->actingAs($user);

        User::factory()->count(2)->create(['is_admin' => true]);

        User::factory()->count(7)->create(['is_admin' => false]);


        $this->get('/api/user?is_admin=1')
            ->assertStatus(200)
            ->assertJsonCount(3, 'data');

        $this->get('/api/user?is_admin=0')
            ->assertStatus(200)
            ->assertJsonCount(7, 'data');
    }
}
