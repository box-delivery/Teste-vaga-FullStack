<?php


namespace App\Http\Controllers;


use App\Models\User;
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
}
