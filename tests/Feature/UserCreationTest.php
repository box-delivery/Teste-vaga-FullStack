<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCreationTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatesUser()
    {
        $response = $this->postJson(route('user_create'), [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'samplepassword', // must be at least 12 chars long
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(['message' => 'User created successfully']);
    }

    public function testValidatesInput()
    {
        $response = $this->postJson(route('user_create'), [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password', // must be at least 12 chars long
        ]);

        $response
            ->assertStatus(422)
            ->assertJson(['errors' => ['password' => ['The password must be at least 12 characters.']]]);
    }

    public function testCantCreateDuplicatedUser()
    {
        $response = $this->postJson(route('user_create'), [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'samplepassword', // must be at least 12 chars long
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(['message' => 'User created successfully']);

        $response_duplicated = $this->postJson(route('user_create'), [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'samplepassword', // must be at least 12 chars long
        ]);

        $response_duplicated
            ->assertStatus(409)
            ->assertJson(['message' => 'User already registered']);
    }

}
