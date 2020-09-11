<?php

namespace App\Http\Controllers;

use App\MovieFavorite;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MoviesFavoritesController extends Controller
{

    public function index($user_id)
    {
        $favorites = MovieFavorite::where('user_id', $user_id)->get();

        if (count($favorites) > 0) {
            return response()->json($favorites, Response::HTTP_OK);
        }

        return response()->json([], Response::HTTP_OK);
    }

    public function add($user_id, $movie_id)
    {
        $favorite = MovieFavorite::where('user_id', $user_id)
                ->where('movie_id', $movie_id)->get();

        if (count($favorite) == 1) {
            return response()->json([
                'error' => false,
                'message' => 'Filme já adicionado, escolha outro filme'
            ], Response::HTTP_OK);
        }

        try {

            MovieFavorite::create([
                'user_id' => $user_id,
                'movie_id' => $movie_id
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Filme adicionado aos favoritos'
            ], Response::HTTP_OK);

        } catch(Exception $e) {

            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    public function remove($user_id, $movie_id)
    {

        try {

            $favorite = MovieFavorite::where('user_id', $user_id)
                ->where('movie_id', $movie_id);
            $favorite->delete();

            return response()->json([
                'error' => false,
                'message' => 'Filme removido dos favoritos'
            ], Response::HTTP_OK);

        } catch(Exception $e) {

            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }
}
