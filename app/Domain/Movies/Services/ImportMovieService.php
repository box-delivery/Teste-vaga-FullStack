<?php

namespace App\Domain\Movies\Services;

use Illuminate\Support\Facades\Http;
use Domain\Movies\Movie;
use Infrastructure\Movies\Repositories\MovieRepository;
use Illuminate\Support\Facades\DB;

class ImportMovieService
{
    private string $path;
    private string $token;
    private MovieRepository $movieRepository;
    private array $parameters;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->path = env('MOVIE_API_URL');
        $this->token = env('MOVIE_API_TOKEN');
        $this->movieRepository = $movieRepository;
        $this->parameters = $this->parameters();
    }

    public function __invoke(int $limit)
    {
        for ($i = 1; $i < $limit; $i++) {
            $this->saveMovie($i);
        }
    }

    private function url(int $id): string
    {
        return sprintf('%s%s',$this->path, $id);
    }

    private function parameters(): array
    {
        return [
            'api_key' => $this->token,
            'language' => 'pt-BR',
        ];
    }

    private function saveMovie(int $id)
    {
        $url = $this->url($id);
    
        $response = Http::get($url, $this->parameters)->json();        
        
        if (!$this->validate($response)) {
            return;
        } 

        $movie = Movie::make($response);
    
        DB::transaction(function () use ($movie) {
            $this->movieRepository->persist($movie);
        });
    }

    private function validate(array $response): bool
    {
        return isset($response['success']) || $this->movieRepository->findByExternalId($response['id']) !== null ? false : true;
    }    
}