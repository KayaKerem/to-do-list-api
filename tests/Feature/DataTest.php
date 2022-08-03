<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DataTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_example()
    {
        $user = User::factory()->create(['is_admin'=>true]);
        $this->actingAs($user);

        User::factory()->count(5)->create();

        $response = $this->get('/api/admin/userdatas');
        dd($response);
        $response->assertStatus(200);
    }
}
