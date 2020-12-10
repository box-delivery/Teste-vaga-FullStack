<?php

use App\TheMovieDB\GenresMovies;
use App\TheMovieDB\Tokens;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Genres;

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('genres')->delete();

        $apiKey = Tokens::apiKey();
        $genres = GenresMovies::genres(
            "{$apiKey}",
            "https://api.themoviedb.org/3/genre/movie/list",
            "GET",
            "pt-BR"
        );
        if(isset($genres["genres"]) && count($genres["genres"]) > 0)
        {
            foreach ($genres["genres"] as $genre)
            {
                Genres::create([
                    'themoviedb_id' => $genre["id"],
                    'name'          => $genre["name"],
                    'description'   => "Gênero ".$genre["name"].", criado apartir da API themoviedb",
                ]);
            }
        }
    }
}
