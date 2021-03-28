<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $movies = Movie::where('title', 'like', "%{$request->movie_title}%")
                ->orWhere('original_title', 'like', "%{$request->movie_title}%")
                ->paginate(20)
                ->toArray();

            unset($movies['links']);
            return response(['message' => 'Filmes encontrados', 'results' => $movies]);
        } catch (Exception $e) {
            Log::info('Erro ao buscar filme: ' . $e);
            return response(['message' => 'Desculpe, algo deu errado :('], 500);
        }
    }
}
