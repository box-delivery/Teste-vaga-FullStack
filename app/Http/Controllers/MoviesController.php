<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movie::all();

        if (count($movies) > 0) {
            return response()->json($movies, Response::HTTP_OK);
        }

        return response()->json([], Response::HTTP_OK);
    }
}
