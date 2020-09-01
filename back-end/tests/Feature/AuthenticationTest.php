<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    public function testRequiredFieldsForRegistration()
    {
        $this->json('POST', 'api/users/register', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "errors" => [
                    "name" => ["The name field is required."],
                    "email" => ["The email field is required."],
                    "password" => ["The password field is required."],
                ]
            ]);
    }

    public function testSuccessfulRegistration()
    {
        $userData = [
            "name" => "John Doe",
            "email" => "doe@example.com",
            "password" => "john12345"
        ];

        $this->json('POST', 'api/users/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "access_token",
                "token_type",
                "expires_in"
            ]);
    }

    public function testMustEnterEmailAndPassword()
    {
        $this->json('POST', 'api/users/login')
            ->assertStatus(422)
            ->assertJson([
                "errors" => [
                    'email' => ["The email field is required."],
                    'password' => ["The password field is required."],
                ]
            ]);
    }

    public function testSuccessfulLogin()
    {
        factory(User::class)->create([
            'email' => 'test@test.com',
            'password' => 'test123',
        ]);

        $loginData = [
            "user" => [
                "email" => "test@test.com",
                "password" => "test123"
            ]
        ];

        $this->json('POST', 'api/users/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'email',
                    'name',
                    'token',
                    'token_type',
                    'expires_in',
                ],
            ]);

        $this->assertAuthenticated();
    }
}
