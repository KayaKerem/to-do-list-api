<?php

namespace Tests\Feature;

use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testRegister()
    {
        Event::fake();
        $response = $this->post('/api/register/',
            ['name' => 'kerem',
                'email' => 'kerem@gmail.com',
                'password' => 'password',
                'is_admin' => false,
                'verification_number'=>'000000'])
            ->assertStatus(200)
            ->assertSee('kerem');
        Event::assertDispatched(UserRegistered::class);

    }

    public function testLogin()
    {
        $user = User::factory()->create();

        $this->post('/api/login/',
            [
                'email' => $user->email,
                'password' => 'password'
            ])
            ->assertStatus(200);
    }
}
