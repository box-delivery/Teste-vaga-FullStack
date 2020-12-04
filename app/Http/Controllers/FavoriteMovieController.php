<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FavoriteMovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = $request->user()->favoriteMovies;

        return MovieResource::collection($movies);
    }

    public function favorite(Movie $movie)
    {
        $movie->favorite();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function unfavorite(Movie $movie)
    {
        $movie->unfavorite();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
