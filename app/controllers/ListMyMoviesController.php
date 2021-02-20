<?php 

namespace App\Controllers;

use DB\DB;

class ListMyMoviesController extends AppController
{

    public function index()
    {
        $db = new DB();

        $movies = [];

        $this->send_json_success([
            'status' => true,
            'message' => 'Lista recuperada com sucesso',
            'movies' => $movies
        ]);
    }

}