<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->truncate();

        $apiKey = env('MOVIE_DB_API_TOKEN');
        $url = env('MOVIE_DB_API_URL');

        $response = Http::get($url, ['api_key' => $apiKey]);
        $movies = $response->json('results');

        collect($movies)->each(function ($movie) {
            DB::table('movies')
                ->insert([
                    'title' => $movie['title'],
                    'overview' => $movie['overview'],
                    'release_date' => $movie['release_date'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        });
    }
}
