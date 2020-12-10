<?php

use App\TheMovieDB\ListMovies;
use App\TheMovieDB\Tokens;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Movies;

class MoviesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('movies')->delete();
        $apiKey = Tokens::apiKey();
        $listPopularCountPages = ListMovies::listPopular(
            "{$apiKey}",
            "https://api.themoviedb.org/3/movie/popular",
            "GET",
            "pt-BR",
            1
        );
        for ($i=1;$i<=$listPopularCountPages["total_pages"];$i++)
        {
            $listPopular = ListMovies::listPopular(
                "{$apiKey}",
                "https://api.themoviedb.org/3/movie/popular",
                "GET",
                "pt-BR",
                $i
            );
            if(isset($listPopular["results"]) && count($listPopular["results"]) > 0)
            {
                foreach ($listPopular["results"] as $movie)
                {
                    $movieCreate = Movies::create([
                        "themoviedb_id"         => $movie["id"] ?? null,
                        "adult"                 => $movie["adult"] ?? null,
                        "backdrop_path"         => $movie["backdrop_path"] ?? null,
                        "original_language"     => $movie["original_language"] ?? null,
                        "original_title"        => $movie["original_title"] ?? null,
                        "overview"              => $movie["overview"] ?? null,
                        "popularity"            => $movie["popularity"] ?? null,
                        "poster_path"           => $movie["poster_path"] ?? null,
                        "release_date"          => $movie["release_date"] ?? null,
                        "title"                 => $movie["title"] ?? null,
                        "video"                 => $movie["video"] ?? null,
                        "vote_average"          => $movie["vote_average"] ?? null,
                        "vote_count"            => $movie["vote_count"] ?? null,
                    ]);
                    $movieCreate->genres()->sync(array_values($movie["genre_ids"]), true);
                }
            }
        }
    }
}
