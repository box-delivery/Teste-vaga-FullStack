<?php


namespace App\Http\Controllers;


use App\Models\Movie;

class MovieController
{
    public function list() {
        $movies = Movie::all();
        return $movies;
    }
}
