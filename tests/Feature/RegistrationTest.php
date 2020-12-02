<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_sign_up()
    {
        $response = $this->postJson('/api/register', $this->data());
        $user = User::query()->first();

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'user' => [
                   'name' => $user->name,
                   'email' => $user->email,
                   'created_at' => $user->created_at->toJson(),
                   'updated_at' => $user->updated_at->toJson(),
               ]
        ]);
    }

    /** @test */
    public function required_fields()
    {
        collect(['name', 'email', 'password'])
            ->each(function ($input) {
                $data[$input] = null;

                $response = $this->postJson('/api/register', $data);
                $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                    ->assertJson([
                        'errors' => [
                            $input => ["The {$input} field is required."]
                        ]
                    ]);
            });
    }

    /** @test */
    public function email_must_be_unique()
    {
        $user = User::factory()->create();
        $data = $this->data();
        $data['email'] = $user->email;

        $this->postJson('/api/register', $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
               'errors' => [
                   'email' => ['The email has already been taken.']
               ]
            ]);
    }

    /** @test */
    public function password_must_have_at_least_8_characters()
    {
        $data = $this->data();
        $data['password'] = 'pass';
        $data['password_confirmation'] = 'pass';

        $this->postJson('/api/register', $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => [
                    'password' => ['The password must be at least 8 characters.']
                ]
            ]);
    }

    /** @test */
    public function password_must_have_a_confirmation()
    {
        $data = $this->data();
        $data['password_confirmation'] = null;

        $this->postJson('/api/register', $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => [
                    'password' => ['The password confirmation does not match.']
                ]
            ]);
    }

    private function data(): array
    {
        return [
          'name' => 'Test',
          'email' => 'test@gmail.com',
          'password' => 'password1234',
          'password_confirmation' => 'password1234',
        ];
    }
}
