<?php

namespace App\Console\Commands;

use App\Models\Movie;
use http\Client;
use Illuminate\Console\Command;

class FillMoviesTable extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:fill {qty : how many movies to retrieve (max: 50)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills movies table with 60 random movies from Movie DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api_key = env("MOVIE_DB_API_KEY");
        $i = 0;
        $qty = filter_var($this->argument('qty'), FILTER_VALIDATE_INT);

        if ($qty === false || $qty <= 0 || $qty > 50) {
            $this->error("Must inform a valid qty between 1 and 50");
            return 1;
        }

        do {
            $id = rand(100, 10000);

            $uri = "https://api.themoviedb.org/3/movie/$id?api_key=$api_key";

            $client = new \GuzzleHttp\Client([
                'http_errors' => false,
            ]);
            $response = $client->get($uri);

            if ($response->getStatusCode() !== 200) {
                $this->error("Movie id $id doesn't exist - trying another");
                continue;
            }

            $data = json_decode($response->getBody());

            $movie = new Movie();
            $movie->movie_db_id = $data->id;
            $movie->title = $data->title;
            $movie->overview = $data->overview;
            $movie->save();

            $i++;
            $this->info("Imported movie {$data->title}");
        } while ($i < $qty);
    }
}
