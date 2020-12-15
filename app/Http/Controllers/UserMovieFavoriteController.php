<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserMovieFavoriteController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()
            ->favoriteMovies()
            ->paginate();
    }

}
