<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class MovieTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        DB::beginTransaction();
        
        $token = $this->userToken();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
            ])
            ->get('/api/movies');

        $response->assertStatus(200);
        
        DB::rollback();
    }

    public function testIndexUnauthenticated()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
            ])
            ->get('/api/movies');

        $response->assertStatus(401);
        
        DB::rollback();
    }

    public function testWithParam()
    {
        DB::beginTransaction();
        
        $token = $this->userToken();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
            ])
            ->get('/api/movies', [
                'movie_title' => 'Batman'
            ]);

        $response->assertStatus(200);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
            ])
            ->get('/api/movies', [
                'movie_title' => ''
            ]);

        $response->assertStatus(200);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
            ])
            ->get('/api/movies', [
                'movie_title' => '123123ljljk112313lj'
            ]);

        $response->assertStatus(200);
        
        DB::rollback();
    }

    /**
     * Retorna um token válido para testes
     *
     * @return void
     */
    private function userToken()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authToken')->accessToken;
        return $token;
    }
}
