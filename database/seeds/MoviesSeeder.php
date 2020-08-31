<?php

use Illuminate\Database\Seeder;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('movies')->truncate();

        $controller = new \App\Http\Controllers\MoviesController();
        $popular = $controller->getPopularMovies();
        foreach ($popular as $movie) {
            $video = $controller->getvideo($movie->id);
            $link = $controller->getLink($movie->id);

            \Illuminate\Support\Facades\DB::table("movies")->insert([
                "name" => $movie->title,
                "desc" => $movie->overview,
                "movie_id" => $movie->id,
                "video" => $video,
                "poster" => "https://image.tmdb.org/t/p/w220_and_h330_face/".$movie->poster_path,
                "release_date" => \Carbon\Carbon::parse($movie->release_date)->toIso8601String(),
                "home_page" => $link,
                "created_at" => \Illuminate\Support\Facades\Date::now()
            ]);
        }

        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@movieflix.com.br',
            'password' => \Illuminate\Support\Facades\Hash::make('movieflix'),
        ]);
    }
}
