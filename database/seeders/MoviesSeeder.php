<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;

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
        $movies = collect([]);

        for ($page=1; $page <= 5 ; $page++) { 
            $response = json_decode(Http::get($this->moviesProvider, [
                "api_key" => env('TMDB_KEY'),
                "language" => "pt_BR",
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
            $movie->release_date = $m->release_date;
            $movie->original_language = $m->original_language;

            $movie->save();
        }
    }
}
