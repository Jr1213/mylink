<?php

namespace Tests\Feature\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class authControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_account()
    {
        $user = User::factory()->make();

        $response = $this->postJson('api/create', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertCreated()->json();

        $this->assertEquals(true, $response['success']);

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email
        ]);
    }
}
