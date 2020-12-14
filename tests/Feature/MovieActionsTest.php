<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserFavoriteMovies;
use App\Services\MovieService;
use App\Services\UserFavoriteMovieService;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class MovieActionsTest extends TestCase
{

    private const VALID_MOVIE_ID = 12;

    /** @var User */
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetAllMovies()
    {

        $moviesMock = $this->mock(Collection::class)->makePartial();

        $movieServiceMock = $this->mock(MovieService::class);
        $movieServiceMock
            ->shouldReceive('getAll')
            ->andReturn($moviesMock);

        $response = $this->actingAs($this->user, 'api')->get('/api/movies');

        $response->assertJsonStructure(['success','data']);
    }

    public function testGetFavoriteMovies()
    {
        $moviesMock = $this->mock(Collection::class)->makePartial();

        $movieServiceMock = $this->mock(MovieService::class);
        $movieServiceMock
            ->shouldReceive('findFavorites')
            ->with($this->user->id)
            ->once()
            ->andReturn($moviesMock);

        $response = $this->actingAs($this->user, 'api')->get('/api/movies/favorites');

        $response->assertJsonStructure(['success','data']);
    }


    public function testFavoriteMovie()
    {

        $favMovieMock = $this->mock(UserFavoriteMovies::class)->makePartial();

        $favServiceMock = $this->mock(UserFavoriteMovieService::class);
        $favServiceMock
            ->shouldReceive('findOneById')
            ->once()
            ->with($this->user->id, self::VALID_MOVIE_ID);

        $favServiceMock
            ->shouldReceive('createOne')
            ->once()
            ->andReturn($favMovieMock);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/movies/favorite', [
            'movieId' => self::VALID_MOVIE_ID
        ]);

        $response->assertJsonStructure(['success','data']);

    }

    public function testDeleteFavoriteMovie()
    {
        $favMovieMock = $this->mock(UserFavoriteMovies::class)->makePartial();

        $favServiceMock = $this->mock(UserFavoriteMovieService::class);
        $favServiceMock
            ->shouldReceive('findOneById')
            ->once()
            ->with($this->user->id, self::VALID_MOVIE_ID);

        $favServiceMock
            ->shouldReceive('deleteOne')
            ->zeroOrMoreTimes()
            ->with($favMovieMock);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/movies/favorite', [
            'movieId' => self::VALID_MOVIE_ID
        ]);

    }

}
