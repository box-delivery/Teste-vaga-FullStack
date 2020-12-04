<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_list_movies()
    {
        $this->actingAsUser();

        $movies = Movie::factory()->count(2)->create();

        $response = $this->getJson('/api/movies');


        $response->assertOk()
            ->assertJson([
                'data' => $movies->toArray()
            ]);

    }

    /** @test */
    public function a_user_can_favorite_a_movie()
    {
        $this->actingAsUser();

        $movies = Movie::factory()->count(2)->create();
        $response = $this->patchJson("api/movies/{$movies->get(1)->id}/favorite");

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseCount('movie_user', 1)
            ->assertDatabaseHas('movie_user', ['movie_id' => 2, 'user_id' => 1]);
    }

    /** @test */
    public function a_user_can_unfavorite_a_movie()
    {
        $this->actingAsUser();

        $movies = Movie::factory()->count(2)->create();
        $movies->get(1)->favorite();

        $response = $this->patchJson("api/movies/{$movies->get(1)->id}/unfavorite");

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseCount('movie_user', 0);
    }

    /** @test */
    public function a_user_can_list_favorite_movies()
    {
        $this->actingAsUser();

        $movies = Movie::factory()->count(10)->create();

        $movies->get(0)->favorite();
        $movies->get(1)->favorite();

        $response = $this->getJson('/api/movies/favorite');
        $response->assertOk()
            ->assertJson([
                'data' => [
                    ['id' => $movies->get(0)->id],
                    ['id' => $movies->get(1)->id],
                ]
            ]);
    }
}
