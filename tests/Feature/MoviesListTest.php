<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class MoviesListTest extends TestCase
{
    use RefreshDatabase;

    /*
     * Disables authentication checks
     */
    use WithoutMiddleware;

    public function testListMovies()
    {
        $title = 'Sample Movie';
        $overview = 'A very short description';
        $movie_db_id = 1000;

        $sample_movie = new Movie();
        $sample_movie->title = $title;
        $sample_movie->overview = $overview;
        $sample_movie->movie_db_id = $movie_db_id;
        $sample_movie->save();

        $response = $this->getJson(route('movie_list'));
        $response->assertStatus(200);

        $movies = $response->json();
        $this->assertEquals(1, count($movies));

        // null coalesce is used to prevent php warnings of undefined index, should api behave incorrectly
        // and doesn't return any movie
        $movie = $movies[0] ?? [];
        $this->assertSame(1, $movie['id'] ?? null);
        $this->assertSame($title, $movie['title'] ?? null);
        $this->assertSame($overview, $movie['overview'] ?? null);
        $this->assertSame($movie_db_id, $movie['movie_db_id'] ?? null);
    }

}
