<?php

namespace Tests\Feature;

use App\Models\Todolist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testProfile()
    {
        $user = User::factory()->create();

         Todolist::factory()->create(['user_id' => $user->id]);

        $this->get('/api/profile/' . $user->id)
            ->assertStatus(200);

    }
}
