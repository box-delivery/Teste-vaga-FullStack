<?php 

namespace App\Clients;

use GuzzleHttp\Client;

class TheMovieDB
{
    private $api_key;

    public function __construct()
    {
        $this->api_key = $_ENV['THEMOVIEDB_API_V3'];
    }

    private function defaultQuery()
    {
        return [
            'api_key'  => $this->api_key,
            'language' => 'pt-BR'
        ];
    }

    public function popular_movies( $args = [] )
    {
        $default = $this->defaultQuery();
        $args = array_merge($default, $args);

        $client = new Client();
        $response = $client->request(
            'GET', 
            'https://api.themoviedb.org/3/movie/popular', 
            [
                'query' => $args
            ]
        );

        $response = json_decode($response->getBody());

        return $response;
    }

    public function movie($movie_id)
    {
        $args = $this->defaultQuery();

        $client = new Client();
        $response = $client->request(
            'GET', 
            'https://api.themoviedb.org/3/movie/'.$movie_id, 
            [
                'query' => $args
            ]
        );

        $response = json_decode($response->getBody());

        return $response;
    }
}