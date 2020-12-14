<?php

namespace App\Http\Controllers;

use App\Models\UserFavoriteMovies;
use App\Services\MovieService;
use App\Services\UserFavoriteMovieService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Json;

class MovieController extends Controller
{

    private const FIELD_MOVIE_ID = 'movieId';

    /** @var MovieService */
    private $service;

    /** @var UserFavoriteMovieService */
    private $userFavoriteMovieService;

    public function __construct(MovieService $service, UserFavoriteMovieService $userFavoriteMovieService)
    {
        $this->service = $service;
        $this->userFavoriteMovieService = $userFavoriteMovieService;
    }


    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $movies = $this->service->getAll();

        return response()->json([
            'success' => true,
            'data' => $movies
        ], 200);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function favoriteMovie(Request $request): JsonResponse
    {

        try {
            $this->validate($request, [
                self::FIELD_MOVIE_ID => 'required|integer'
            ]);

            $user = Auth::user();
            $movieId = $request->post(self::FIELD_MOVIE_ID);
            $movie = $this->service->findOneByIdOrNull($movieId);

            if (!$movie) {
                return response()->json([
                    'error' => 'Este filme não existe na base de dados'
                ], 200);
            }


            $favoriteMovie = $this->userFavoriteMovieService->findOneById($user->id, $movieId);

            if ($favoriteMovie) {
                return response()->json([
                    'error' => "Este filme já foi favoritado por você.",
                ], 200);
            }

            $fav = $this->userFavoriteMovieService->createOne([
                UserFavoriteMovies::FIELD_USER_ID => $user->id,
                UserFavoriteMovies::FIELD_MOVIE_ID => $movieId
            ]);

            return response()->json([
                'success' => true,
                'data' => $fav
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 422);
        }

    }

    /**
     * @return JsonResponse
     *
     */
    public function listFavorites(): JsonResponse
    {
        try {

            $user = Auth::user();

            $favoriteMovies = $this->service->findFavorites($user->id);

            return response()->json([
                'success' => true,
                'data' => $favoriteMovies
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
            ], 422);
        }

    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function deleteFavoriteMovie(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                self::FIELD_MOVIE_ID => 'required|integer'
            ]);

            $user = Auth::user();
            $movieId = $request->post(self::FIELD_MOVIE_ID);

            $favMovie = $this->userFavoriteMovieService->findOneById($user->id, $movieId);

            if ($favMovie) {
                $this->userFavoriteMovieService->deleteOne($favMovie);

                return response()->json([
                    'success' => true,
                    'message' => 'Favorito removido'
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'Favorito não encontrado'
            ], 200);


        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 422);
        }
    }

}
