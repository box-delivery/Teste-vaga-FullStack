<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PassportAuthTest extends TestCase
{

    public function testRegisterUser(): void
    {

        $userMock = $this->mock(User::class)->makePartial();

        $userMock
            ->shouldReceive('createToken')
            ->once()
            ->passthru();

        $serviceMock = $this->mock(UserService::class);
        $serviceMock
            ->shouldReceive('createOne')
            ->once()
            ->andReturn($userMock);

        $result = $this->postJson('/api/register', [
            'name' => 'Lucas Souza',
            'email' => 'email@email.com',
            'password' => '123'
        ]);

        $this->assertJson($result->content());
    }

    public function testLogin(): void
    {

        $result = $this->post('/api/login', [
            'email' => 'lcacao@gmail.com',
	        'password' => '123'
        ]);

        $this->assertJson($result->content());
    }

}
