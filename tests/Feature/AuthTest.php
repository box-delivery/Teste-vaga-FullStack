<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_without_name()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Fulano",
            "last_name" => "",
            "email" => "fulano@gmail.com",
            "password" => "123456",
            "password_confirmation" => "123456"
        ]);

        $response->assertStatus(422);

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "",
            "last_name" => "Ciclano",
            "email" => "yanw100@gmail.com",
            "password" => "123456",
            "password_confirmation" => "123456"
        ]);

        $response->assertStatus(422);
    }

    public function test_register_without_email()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Yan",
            "last_name" => "Ciclano",
            "email" => "",
            "password" => "123456",
            "password_confirmation" => "123456"
        ]);

        $response->assertStatus(422);
    }

    public function test_register_password_validation()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Yan",
            "last_name" => "Ciclano",
            "email" => "fulano@mail.com",
            "password" => "12346",
            "password_confirmation" => "123456"
        ]);

        $response->assertStatus(422);

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Yan",
            "last_name" => "Ciclano",
            "email" => "fulano@mail.com",
            "password" => "123456",
            "password_confirmation" => "12346"
        ]);

        $response->assertStatus(422);

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Yan",
            "last_name" => "Ciclano",
            "email" => "fulano@mail.com",
            "password" => "",
            "password_confirmation" => "123456"
        ]);

        $response->assertStatus(422);

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Yan",
            "last_name" => "Ciclano",
            "email" => "fulano@mail.com",
            "password" => "123456",
            "password_confirmation" => ""
        ]);

        $response->assertStatus(422);

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Yan",
            "last_name" => "Ciclano",
            "email" => "fulano@mail.com",
            "password" => "",
            "password_confirmation" => ""
        ]);

        $response->assertStatus(422);
    }

    public function test_register_user()
    {
        DB::beginTransaction();
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Fulano",
            "last_name" => "Ciclano",
            "email" => "fulano@mail.com",
            "password" => "123456",
            "password_confirmation" => "123456"
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'user' => [
                "first_name",
                "last_name",
                "email",
                "updated_at",
                "created_at",
                "id"
            ],
            'access_token'
        ]);
        DB::rollback();
    }

    public function test_register_duplicated_email()
    {
        DB::beginTransaction();

        $user = $this->createTestUser();

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Fulano",
            "last_name" => "Ciclano",
            "email" => $user->email,
            "password" => "123456",
            "password_confirmation" => "123456"
        ]);

        $response->assertStatus(422);
        DB::rollback();
    }

    public function test_valid_login()
    {
        DB::beginTransaction();

        $user = $this->createTestUser();

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/login', [
            "email" => $user->email,
            "password" => "123456",
        ]);

        $response->assertStatus(200);
        DB::rollback();
    }

    public function test_invalid_login()
    {
        DB::beginTransaction();

        $user = $this->createTestUser();

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/login', [
            "email" => $user->email,
            "password" => "12345",
        ]);

        $response->assertStatus(422);

        DB::rollback();
    }

    public function test_login_token_return()
    {
        DB::beginTransaction();

        $user = $this->createTestUser();

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/login', [
            "email" => $user->email,
            "password" => "123456",
        ]);

        $response->assertJsonStructure([
            'user' => [
                "first_name",
                "last_name",
                "email",
                "updated_at",
                "created_at",
                "id"
            ],
            'access_token'
        ]);

        DB::rollback();
    }

    /**
     * Criar um usuário para teste
     *
     * @return void
     */
    private function createTestUser()
    {
        return $user = User::create([
            "first_name" => "Fulano",
            "last_name" => "Ciclano",
            "email" => "fulano@mail.com",
            "password" => bcrypt("123456"),
        ]);
    }
}
