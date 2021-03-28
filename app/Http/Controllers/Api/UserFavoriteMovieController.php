<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserFavoriteMovie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UserFavoriteMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $movies = UserFavoriteMovie::select(
                'movies.id',
                'movies.title',
                'movies.original_title',
                'movies.overview',
                'movies.release_date',
                'movies.original_language'
            )->Join('movies', 'movies.id', 'user_favorite_movies.movie_id')
                ->where('movies.title', 'like', "%{$request->movie_title}%")
                ->orWhere('movies.original_title', 'like', "%{$request->movie_title}%")
                ->paginate(20)
                ->toArray();

            unset($movies['links']);
            return response(['message' => 'Favoritos encontrados', 'results' => $movies]);
        } catch (Exception $e) {
            Log::info('Erro ao buscar favoritos: ' . $e);
            return response(['message' => 'Desculpe, algo deu errado :('], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $userId)
    {
        $validatedData = $request->validate([
            'movie_id' => 'required|numeric|exists:movies,id'
        ]);

        try {
            if ($userId != auth()->user()->id) {
                return response(['message' => 'forbidden'], 403);
            }

            DB::beginTransaction();

            $favoriteMovie = UserFavoriteMovie::create([
                'user_id' => $userId,
                'movie_id' => $validatedData['movie_id']
            ]);

            DB::commit();
            return response([
                'message' => 'adicionado filme nos favoritos', 'movie_id' => $favoriteMovie->movie_id]);
        } catch (Exception $e) {
            DB::rollback();
            Log::info('Erro ao favoritar filme: ' . $e);
            return response(['message' => 'Desculpe, algo deu errado :('], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, $movieId)
    {
        try {
            DB::beginTransaction();
            if ($userId != auth()->user()->id) {
                return response(['message' => 'forbidden'], 403);
            }

            $user = auth()->user();
            $favoriteMovie = $user->favoriteMovies()->where('movie_id', $movieId)->first();

            if (empty($favoriteMovie)) {
                return response(['message' => 'Filme não se encontra nos favoritos do usuário', 'errors' => ['movie_id' => 'filme não encontrado nos favoritos']], 422);
            }

            $favoriteMovie->where([['user_id', $userId], ['movie_id', $movieId]])->delete();
            DB::commit();
            return response(['message' => 'Filme removido dos favoritos', 'movie_id' => $movieId]);
        } catch (Exception $e) {
            DB::rollback();
            Log::info('Erro ao remover filme dos favoritos: ' . $e);
            return response(['message' => 'Desculpe, algo deu errado :('], 500);
        }
    }
}
