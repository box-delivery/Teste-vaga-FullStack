<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use App\Models\Movies;
use Illuminate\Support\Facades\Auth;

class StartController extends Controller
{
    public function index()
    {
        $movies = Movies::query()->limit(4)->inRandomOrder()->get();

        if(Auth::user() !== null) {
            $favorites = Favorites::query()->where('user_id', Auth::user()->id)->get()->toArray();
            if (!empty($favorites)) {
                foreach ($favorites as $fav) {
                    $favoriteMovies[] = $fav['movie_id'];
                }
            } else {
                $favoriteMovies = [];
            }
            return view('frontEnd.index', compact("movies", "favoriteMovies"));
        }

        return view('frontEnd.index', compact("movies"));
    }
}
