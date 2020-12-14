<?php


namespace App\Services;

use App\Models\UserFavoriteMovies;
use Exception;

class UserFavoriteMovieService
{
    /** @var UserFavoriteMovies */
    private $model;

    /**
     * UserFavoriteMovieService constructor.
     * @param UserFavoriteMovies $model
     */
    public function __construct(UserFavoriteMovies $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $userId
     * @param int $movieId
     *
     * @return UserFavoriteMovies|null
     */
    public function findOneById(int $userId, int $movieId): ?UserFavoriteMovies
    {
       $favMovie = $this->model->newModelQuery();

       return $favMovie
           ->where(UserFavoriteMovies::FIELD_USER_ID, $userId)
           ->where(UserFavoriteMovies::FIELD_MOVIE_ID, $movieId)
           ->first();
    }

    /**
     * @param array $data
     *
     * @return UserFavoriteMovies
     */
    public function createOne(array $data): UserFavoriteMovies
    {
        $favMovie = $this->model->newInstance();
        $favMovie->fill($data);
        $favMovie->save();

        return $favMovie;

    }

    /**
     * @param UserFavoriteMovies $favMovie
     * @throws Exception
     */
    public function deleteOne(UserFavoriteMovies $favMovie): void
    {
        $favMovie->delete();
    }


}
