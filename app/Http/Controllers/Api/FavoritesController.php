<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Validator;

use App\Models\User;
use App\Models\Movie;
use App\Models\UserMovie;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{

    /**
     * Index (Get List)
     *
     * @param  int $start
     * @param  int $limit
     */
	public function index(Request $request) {

		$start 	= $request->start ?: 0;
		$limit 	= $request->limit ?: 5;

		$movies = User::find($request->user_id)->movies;
		
		return $this->resp(true, ['results' => $movies]);

	}

    /**
     * store create (PUT)
     *
     * @param  int $movie_id
     */
	public function store(Request $request, $movie_id) {

		$movie 	= Movie::find($movie_id);

		// Valida se é um filme válido
		if( $movie ) {

			$favorite = UserMovie::firstOrCreate([
				'user_id'			=> $request->user_id,
				'movie_id'			=> $movie->id
			]);

			// Favorita filme
			if( $favorite ) {

				return $this->resp(true, $favorite);

			} else return $this->resp(false, 'error to favorite movie');
			    
		} else return $this->resp(false, 'movie not found');

	}

    /**
     * delete (DELETE)
     *
     * @param  int $movie_id
     */
	public function delete(Request $request, $movie_id) {

		$removeFavorite 	= UserMovie::where('movie_id', $movie_id)
			->where('user_id', $request->user_id)
			->delete();

		if( $removeFavorite ) {

			return $this->resp(true, 'bookmark successfully removed');

		} return $this->resp(false, 'this film is not a favorite');

	}

}