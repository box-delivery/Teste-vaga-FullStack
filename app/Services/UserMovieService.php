<?php


namespace App\Services;


use App\Exceptions\MovieNotFoundException;
use App\Models\Movie;
use App\Models\User;
use App\Repositories\Movie as MovieRepository;
use Illuminate\Support\Facades\Auth;

class UserMovieService
{

    /**
     * @var MovieRepository
     */
    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    /**
     * @return \App\Models\Movie[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getMoviesFromCurrentUser()
    {
        /** @var User $user */
        $user = Auth::user();
        return $user->movies;
    }

    /**
     * @param $movie_id
     * @return bool
     */
    public function addMovieToCurrentUserList($movie_id)
    {
        // check that movie exists
        $movie = $this->movieRepository->getMovieById($movie_id);
        if ($movie === null) {
            throw new MovieNotFoundException('Movie not found');
        }

        /** @var User $user */
        $user = Auth::user();

        if (in_array($movie_id, $user->movies->pluck('id')->toArray())) {
            return true;
        }

        $user->movies()->attach($movie_id);
        return true;
    }

    public function deleteMovieFromCurrentUserList($movie_id)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!in_array($movie_id, $user->movies->pluck('id')->toArray())) {
            return true;
        }

        $user->movies()->detach($movie_id);
        return true;
    }


}
