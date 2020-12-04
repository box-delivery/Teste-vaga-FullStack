<?php

namespace Tests\Feature;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UserMovieListTest extends TestCase
{
    use RefreshDatabase;

    /*
     * Disables authentication checks
     */
    use WithoutMiddleware;

    /**
     * @var User|null
     */
    private $user = null;

    protected function setUp(): void
    {
        parent::setUp();

        // create a user and attach a movie
        $this->user = new User();
        $this->user->name = 'Test User';
        $this->user->email = 'test@test.com';
        $this->user->password = '';
        $this->user->save();

        // add a single movie to the database
        $title = 'Sample Movie';
        $overview = 'A very short description';
        $movie_db_id = 1000;

        $sample_movie = new Movie();
        $sample_movie->title = $title;
        $sample_movie->overview = $overview;
        $sample_movie->movie_db_id = $movie_db_id;
        $sample_movie->save();
    }

    public function testListUserMoviesEmpty()
    {
        $response = $this->actingAs($this->user)
            ->getJson(route('user_movie_list'));
        $response->assertStatus(200);
        $this->assertCount(0, $response->json());
    }

    public function testAddUserMovie()
    {
        $response = $this->actingAs($this->user)
            ->putJson(route('user_movie_put'), [
                'movie_id' => 1
            ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Movie added to user list']);
    }

    public function testIgnoreDuplicateMovieInsert()
    {
        $first_response = $this->actingAs($this->user)
            ->putJson(route('user_movie_put'), [
                'movie_id' => 1
            ]);

        $first_response->assertStatus(200);
        $first_response->assertJson(['message' => 'Movie added to user list']);

        // update user relations so that can avoid
        $this->user->refresh();

        $second_response = $this->actingAs($this->user)
            ->putJson(route('user_movie_put'), [
                'movie_id' => 1
            ]);

        $second_response->assertStatus(200);
        $second_response->assertJson(['message' => 'Movie added to user list']);
    }

    public function testInsertNonexistentMovie()
    {
        $response = $this->putJson(route('user_movie_put'), [
            'movie_id' => 10
        ]);

        $response->assertStatus(404);
        $response->assertJson(['message' => 'Movie not found']);
    }

    public function testDeleteMovie()
    {
        $this->user->movies()->attach(1);

        $response = $this->actingAs($this->user)
            ->deleteJson(route('user_movie_delete', ['movie_id' => 1]));

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Movie removed from user list']);
    }

    public function testDeleteIgnoreNonexistentMovie()
    {
        $response = $this->actingAs($this->user)
            ->deleteJson(route('user_movie_delete', ['movie_id' => 99999999]));

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Movie removed from user list']);
    }
}
