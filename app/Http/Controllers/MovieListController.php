<?php


namespace App\Http\Controllers;


use App\Http\Requests\AddMovieToUserListRequest;
use App\Models\User;
use App\Services\UserMovieService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class MovieListController
{
    public function list()
    {
        /** @var User $user */
        $user = Auth::user();
        return Response::json($user->movies);
    }

    public function put(AddMovieToUserListRequest $request) {
        $movie_id = $request->get('movie_id');

        $userMovieService = new UserMovieService();
        $userMovieService->addMovieToCurrentUserList($movie_id);

        return Response::json([
            'message' => 'Movie added to user list',
        ]);
    }
}
