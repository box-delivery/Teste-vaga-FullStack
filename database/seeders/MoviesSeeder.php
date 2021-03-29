<?php

namespace Database\Seeders;

use Exception;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MoviesSeeder extends Seeder
{
    private $moviesProvider = "https://api.themoviedb.org/3/movie/popular";
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $movies = collect([]);
            DB::beginTransaction();
            if (empty(Movie::first())) {
                for ($page = 1; $page <= 10; $page++) {
                    $response = json_decode(Http::get($this->moviesProvider, [
                        "api_key" => env('TMDB_KEY'),
                        "language" => "pt-BR",
                        "page" => $page
                    ])->body());
        
                    foreach ($response->results as $key => $movie) {
                        $movies->push($movie);
                    }
                }
        
                foreach ($movies as $key => $m) {
                    $movie = new Movie();
        
                    $movie->title = $m->title;
                    $movie->original_title = $m->original_title;
                    $movie->overview = $m->overview;
                    $movie->release_date = isset($m->release_date) ? $m->release_date : null;
                    $movie->original_language = isset($m->original_language) ? $m->original_language : null;
        
                    $movie->save();
                }
            }
            DB::commit();
        } catch (Exception $e) {
            Log::info('Registrando erro no seed de filmes: ' . $e);
            DB::rollback();
        }
    }
}
