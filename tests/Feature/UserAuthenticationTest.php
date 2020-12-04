<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccessfullyAuthenticates()
    {
        $user = new User();
        $user->name = 'Test User';
        $user->email = 'test@test.com';
        $user->password = bcrypt('samplepassword');
        $user->save();

        // create user for auth testing
        $response = $this->postJson(route('auth_login'), [
            'email' => 'test@test.com',
            'password' => 'samplepassword', // must be at least 12 chars long
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(['token_type' => 'bearer']);

        $this->assertTrue(isset($response['access_token']));
        $this->assertTrue(isset($response['expires_in']));
    }

    public function testWrongPasswordFails()
    {
        $user = new User();
        $user->name = 'Test User';
        $user->email = 'test@test.com';
        $user->password = bcrypt('samplepassword');
        $user->save();

        // create user for auth testing
        $response = $this->postJson(route('auth_login'), [
            'email' => 'test@test.com',
            'password' => 'wrongpassword', // must be at least 12 chars long
        ]);

        $response
            ->assertStatus(401)
            ->assertJson(['error' => 'Unauthorized']);
    }

}
