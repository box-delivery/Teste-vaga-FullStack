<?php


namespace App\Services;


use App\Models\Movie;
use App\Models\User;
use App\Models\UserFavoriteMovies;
use Illuminate\Database\Eloquent\Collection;

class MovieService
{

    /** @var Movie */
    private $model;

    /**
     * MovieService constructor.
     *
     * @param Movie $model
     */
    public function __construct(Movie $model)
    {
        $this->model = $model;
    }


    /**
     * @param $movieId
     *
     * @return Movie|null
     */
    public function findOneByIdOrNull($movieId): ?Movie
    {
        $query = $this->model->newModelQuery();
        return $query
            ->where(Movie::FIELD_ID, $movieId)
            ->first();
    }

    /**
     * @return Collection|null
     */
    public function getAll(): ?Collection
    {
        $query = $this->model->newModelQuery();

        return $query->get();

    }

    /**
     * @param array $data
     *
     * @return Movie
     */
    public function createOne(array $data): Movie
    {
        $movie = $this->model->newInstance();
        $movie->fill($data);
        $movie->save();


        return $movie;
    }


    /**
     * @param int $userId
     * @return Collection|null
     */
    public function findFavorites(int $userId): ?Collection
    {
        $favorites = $this->model->newModelQuery();
        $favorites
            ->from(sprintf('%s as %s', Movie::TABLE_NAME, Movie::TABLE_ALIAS))
            ->join(
                sprintf('%s AS %s', UserFavoriteMovies::TABLE_NAME, UserFavoriteMovies::TABLE_ALIAS),
                function ($join) {
                    $join->on(
                        sprintf('%s.%s', UserFavoriteMovies::TABLE_ALIAS, UserFavoriteMovies::FIELD_MOVIE_ID),
                        '=',
                        sprintf('%s.%s', Movie::TABLE_ALIAS, Movie::FIELD_ID)
                    );
                })
            ->where(
                sprintf('%s.%s', UserFavoriteMovies::TABLE_ALIAS, UserFavoriteMovies::FIELD_USER_ID),
                $userId
            );

        return $favorites->get();

    }

}
