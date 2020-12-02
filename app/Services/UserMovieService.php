<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserMovieService
{

    /**
     * @return \App\Models\Movie[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getMoviesFromCurrentUser() {
        /** @var User $user */
        $user = Auth::user();
        return $user->movies;
    }

    /**
     * @param $movie_id
     * @return bool
     */
    public function addMovieToCurrentUserList($movie_id) {
        /** @var User $user */
        $user = Auth::user();

        if (in_array($movie_id, $user->movies->pluck('id')->toArray())) {
            return true;
        }

        $user->movies()->attach($movie_id);
        return true;
    }



}
