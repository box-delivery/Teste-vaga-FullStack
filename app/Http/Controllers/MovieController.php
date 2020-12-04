<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies =  Movie::all();

        return MovieResource::collection($movies);
    }
}
