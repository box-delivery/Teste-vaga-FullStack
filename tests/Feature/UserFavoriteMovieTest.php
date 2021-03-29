<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;
use App\Models\UserFavoriteMovie;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserFavoriteMovieTest extends TestCase
{
    public function testRoutesAsUnauthenticatedUser()
    {
        DB::beginTransaction();
        
        $user = $this->user();

        $response = $this->withHeaders([
            'Accept' => 'application/json'
            ])
            ->get("/api/users/{$user->id}/favorites");

        $response->assertStatus(401);

        $user = $this->user();
        $movie = Movie::first();

        $response = $this->withHeaders([
            'Accept' => 'application/json'
            ])
            ->post("/api/users/{$user->id}/favorites", ['movie_id' => $movie->id]);

        $response->assertStatus(401);

        $response = $this->withHeaders([
            'Accept' => 'application/json'
            ])
            ->delete("/api/users/{$user->id}/favorites/{$movie->id}");

        $response->assertStatus(401);
        
        DB::rollback();
    }

    public function testGetFavoriteUserMovies()
    {
        DB::beginTransaction();
        
        $user = $this->user();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user->token
            ])
            ->get("/api/users/{$user->id}/favorites");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'results'
        ]);

        DB::rollback();
    }

    public function testInsertFavoriteMovie()
    {
        DB::beginTransaction();
        
        $user = $this->user();
        $movie = Movie::first();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user->token
            ])->post("/api/users/{$user->id}/favorites", [
            "movie_id" => $movie->id
        ]);

        $response->assertStatus(200);

        $favoriteMovie = UserFavoriteMovie::where('user_id', $user->id)->where('movie_id', $movie->id)->first();
        $this->assertEquals($movie->id, $favoriteMovie->movie_id);
        DB::rollback();
    }

    public function testInsertFavoriteMovieWithNoId()
    {
        DB::beginTransaction();
        
        $user = $this->user();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user->token
            ])->post("/api/users/{$user->id}/favorites", [
            "movie_id" => ''
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors'
        ]);
        DB::rollback();
    }

    public function testInsertFavoriteMovieWithInvalidId()
    {
        DB::beginTransaction();
        
        $user = $this->user();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user->token
            ])->post("/api/users/{$user->id}/favorites", [
            "movie_id" => 99999
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors'
        ]);
        DB::rollback();
    }

    public function testFavoriteMovieDelete()
    {
        DB::beginTransaction();
        $user = $this->user();
        $movie = Movie::first();

        UserFavoriteMovie::create([
            'user_id' => $user->id,
            'movie_id' => $movie->id
            ]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user->token
            ])->delete("/api/users/{$user->id}/favorites/{$movie->id}");

        $response->assertStatus(200);

        $deletedMovie = $user->favoriteMovies()->where('movie_id', $movie->id)->first();

        $this->assertEquals($deletedMovie, null);

        DB::rollback();
    }

    public function testFavoriteMovieDeleteWithNoId()
    {
        DB::beginTransaction();
        $user = $this->user();
        $movie = Movie::first();

        UserFavoriteMovie::create([
            'user_id' => $user->id,
            'movie_id' => $movie->id
            ]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user->token
            ])->delete("/api/users/{$user->id}/favorites/");

        $response->assertStatus(405);

        DB::rollback();
    }

    public function testFavoriteMovieDeleteWithWrongId()
    {
        DB::beginTransaction();
        $user = $this->user();
        $movie = Movie::first();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user->token
            ])->delete("/api/users/{$user->id}/favorites/{$movie->id}");

        $response->assertStatus(422);

        DB::rollback();
    }


    public function testGetFavoriteUserMoviesWithParam()
    {
        DB::beginTransaction();
        
        $user = $this->user();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user->token
            ])
            ->get("/api/users/{$user->id}/favorites", [
                'movie_title' => 'Batman'
            ]);

        $response->assertStatus(200);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user->token
            ])
            ->get("/api/users/{$user->id}/favorites", [
                'movie_title' => ''
            ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'results'
        ]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user->token
            ])
            ->get("/api/users/{$user->id}/favorites", [
                'movie_title' => '123123ljljk112313lj'
            ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'results'
        ]);

        DB::rollback();
    }

    /**
     * Retorna um token válido para testes
     *
     * @return User
     */
    private function user()
    {
        $user = User::factory()->create();
        $user->token = $user->createToken('authToken')->accessToken;
        return $user;
    }
}
