<?php 

namespace App\Controllers;

use App\Models\Movie;

class ListMoviesController extends AppController
{

    public function index()
    {
        $movieModel = new Movie();

        $movies = $movieModel->popular_movies(
            [       
                'language' => 'pt-BR'
            ]
        );

        $this->send_json_success(
            [
                'status' => true,
                'message' => 'Lista recuperada com sucesso',
                'movies' => $movies
            ]
        );
    }

}