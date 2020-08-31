<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use App\Models\Movies;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class MoviesController extends Controller
{
    public function list() {
        $movies = Movies::query()->paginate(8);
        $favorites = Favorites::query()->where('user_id', Auth::user()->id)->get()->toArray();
        if (!empty($favorites)) {
            foreach ($favorites as $fav) {
                $favoriteMovies[] = $fav['movie_id'];
            }
        } else {
            $favoriteMovies = [];
        }

        return view('frontEnd.list', compact("movies", "favoriteMovies"));
    }

    public function addToFavorites($id) {

        $fav = new Favorites();
        $fav['movie_id'] = $id;
        $fav['user_id'] = Auth::user()->id;

        if ($fav->save()) {
            return response()->json('success', 200);
        } else {
            return response()->json('error', 400);
        }
    }

    public function removeFromFavorites($id) {
        $fav = Favorites::query()->where("movie_id", $id)->where("user_id", Auth::user()->id);

        if ($fav->delete()) {
            return response()->json('success', 200);
        } else {
            return response()->json('error', 400);
        }
    }


    public function favorites() {
        $favorites = Favorites::query()->where('user_id', Auth::user()->id)->get()->toArray();

        if (!empty($favorites)) {
            foreach ($favorites as $fav) {
                $array[] = Movies::query()->where('movie_id', $fav['movie_id'])->get()->toArray();
                $favoriteMovies[] = $fav['movie_id'];
            }
        } else {
            $array = [];
            $favoriteMovies = [];
        }

        return view('frontEnd.favorites', compact("array", "favoriteMovies"));
    }

    public function getPopularMovies() {
        $result = $this->requestAPI("popular");
        if($result === null) {
            return redirect()->back()->with('error', 'Falha ao consultar API, por favor, tente novamente mais tarde.');
        }

        return $result->results;
    }

    public function getVideo($id) {
        $result = $this->requestAPI($id."/videos");
        if ($result !== null || !empty($result)) {
            if (@$result->results[0]->key) {
                $result = $result->results[0]->key;
            } else {
                $result = "";
            }
        } else {
            $result = "";
        }
        return $result;
    }

    public function getLink($id) {
        $result = $this->requestAPI($id);
        if ($result !== null || !empty($result)) {
            if (@$result->homepage) {
                $result = $result->homepage;
            } else {
                $result = "";
            }
        } else {
            $result = "";
        }
        return $result;
    }

    public function updateMovies() {
        if(Artisan::call("db:seed --class=MoviesSeeder") === 0) {
            return redirect()->back()->with('success', "updated!");
        } else {
            return redirect()->back()->with('ops', "try again!");
        }
    }
}
