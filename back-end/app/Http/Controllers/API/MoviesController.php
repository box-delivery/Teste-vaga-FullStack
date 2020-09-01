<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class MoviesController extends Controller
{

    /**
     * Returns all movies - paginated
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $movies = Movie::with('favorite')->paginate(10);
        return response()->json($movies, 200);
    }

    /**
     * @param int $page
     * @param false $totalPages
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public static function importMovies($page = 1, $totalPages = false)
    {
        try {
            // Create a cURL handle.
            $curl = curl_init();
            // Set multiple options for a cURL transfer
            curl_setopt_array($curl,
                [
                    CURLOPT_URL => ENV('TMDB_URL').'?api_key='.ENV('TMDB_KEY').'&language=pt-BR&page='.$page,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => [
                        "cache-control: no-cache"
                    ],
                ]
            );
            // Execute the given cURL session.
            $response = curl_exec($curl);
            curl_close($curl);
            $movies = json_decode($response);

            if ($totalPages) {
                return $movies->total_pages;
            }
            return $movies;
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }
}
