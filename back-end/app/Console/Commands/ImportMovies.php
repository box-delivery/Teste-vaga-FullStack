<?php

namespace App\Console\Commands;

use App\Http\Controllers\API\MoviesController;
use App\Models\Movie;
use Illuminate\Console\Command;

class ImportMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import movies API TMDB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        ini_set('memory_limit', '-1');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dump("############################################################################################");
        dump('['.date('Y-m-d H:i:s').'] local.INFO: Starting to import movies');

        $totalPages = MoviesController::importMovies(1, true);
        $count=0;
        for ($i=1; $i<=$totalPages; $i++) {
            $movies = MoviesController::importMovies($i);
            foreach ($movies->results as $movie) {
                $count++;
                Movie::firstOrCreate(
                    [
                        'codigo' => $movie->id
                    ],
                    [
                    'codigo' => $movie->id,
                    'title' => $movie->title,
                    'original_title' => $movie->original_title,
                    'overview' => $movie->overview,
                    'poster_path' => $movie->poster_path
                ]);
            }
            # display imported quantity on the console
            if ($count % 1000 == 0) {
                dump('Imported quantity: '.$count );
            }
        }

        dump('['.date('Y-m-d H:i:s').'] local.INFO: Movies import completed');
        dd("############################################################################################");
    }
}
