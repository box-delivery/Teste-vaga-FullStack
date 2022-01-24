<?php

namespace App\Console\Commands;

use App\Models\Movies;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class PopulateMoviesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to populate Movies Table';

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
        $this->info('Populando tabela de filmes');
        $this->populateTable();
        $this->info('Tabela populada');
        return 0;
    }

    protected function populateTable()
    {
        $currPage = 1;
        $pages = 2;
        $totalMovies = 0;
        $moviesEndpoint = 'https://api.themoviedb.org/3/movie/upcoming';
        while($currPage < $pages) {
            $response = Http::get($moviesEndpoint,[
                'api_key' => env('TMDB_API'),
                'language' => 'en-US',
                'page' => $currPage,
            ])->json();
            $pages = $response['total_pages'];
            $currPage++;
            if ($totalMovies == 0) {
                $totalMovies = $response['total_results'];
                $bar = $this->output->createProgressBar($totalMovies);
                $bar->start();
            }

            foreach ($response['results'] as $movie) {
                Movies::updateOrCreate([
                    'external_id'=> $movie['id']
                ],[
                    'external_id'=> $movie['id'],
                    'title' => $movie['title'],
                    'original_title' => $movie['original_title'],
                    'adult' => $movie['adult'],
                    'language' => $movie['original_language'],
                    'original_language' => $movie['original_language'],
                    'release_date' => $movie['release_date'],
                    'overview' => $movie['overview'],
                    'poster_path' => 'https://image.tmdb.org/t/p/original/'.$movie['poster_path'],
                ]);
                $bar->advance();
            }
        }
        $bar->finish();
        $this->info('');
    }
}
