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
    public function testRegisterWithoutName()
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
            "email" => "fulano@gmail.com",
            "password" => "123456",
            "password_confirmation" => "123456"
        ]);

        $response->assertStatus(422);
    }

    public function testRegisterWithoutEmail()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Fulano",
            "last_name" => "Ciclano",
            "email" => "",
            "password" => "123456",
            "password_confirmation" => "123456"
        ]);

        $response->assertStatus(422);
    }

    public function testRegisterPasswordValidation()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Fulano",
            "last_name" => "Ciclano",
            "email" => "fulano@mail.com",
            "password" => "12346",
            "password_confirmation" => "123456"
        ]);

        $response->assertStatus(422);

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Fulano",
            "last_name" => "Ciclano",
            "email" => "fulano@mail.com",
            "password" => "123456",
            "password_confirmation" => "12346"
        ]);

        $response->assertStatus(422);

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Fulano",
            "last_name" => "Ciclano",
            "email" => "fulano@mail.com",
            "password" => "",
            "password_confirmation" => "123456"
        ]);

        $response->assertStatus(422);

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Fulano",
            "last_name" => "Ciclano",
            "email" => "fulano@mail.com",
            "password" => "123456",
            "password_confirmation" => ""
        ]);

        $response->assertStatus(422);

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            "first_name" => "Fulano",
            "last_name" => "Ciclano",
            "email" => "fulano@mail.com",
            "password" => "",
            "password_confirmation" => ""
        ]);

        $response->assertStatus(422);
    }

    public function testRegisterUser()
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

    public function testRegisterDuplicatedEmail()
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

    public function testValidLogin()
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

    public function testInvalidLogin()
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

    public function testLoginTokenReturn()
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
     * @return User
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
