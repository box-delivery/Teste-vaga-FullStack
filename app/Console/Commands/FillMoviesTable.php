<?php

namespace App\Console\Commands;

use App\Services\MovieService;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Http\JsonResponse;

class FillMoviesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:fill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @param MovieService $movieService
     *
     * @throws GuzzleException
     */
    public function handle(MovieService $movieService): void
    {

        try {
            $client = new Client();

            $url = sprintf('%s/%s?api_key=%s&language=%s',
                config('app.movie_db.base_url'),
                'movie/top_rated',
                config('app.movie_db.key'),
                config('app.movie_db.language'),
            );

            $response = $client->request('GET', $url, ['verify' => false]);

            $movies = json_decode($response->getBody());

            foreach ($movies->results as $movie) {

                $movieService->createOne([
                    'title' => $movie->title,
                    'overview' => $movie->overview,
                    'poster_url' => $movie->poster_path,
                    'rating' => $movie->vote_average,
                ]);
            }


        } catch (Exception $exception) {

        }


    }
}
