<?php 

namespace App\Controllers;

use App\Filters\AuthFilter;
use App\Models\Movie;
use DB\DB;

class ListMyMoviesController extends AppController
{

    public function index()
    {
        try{
            $auth = new AuthFilter();
            $movieModel = new Movie();
            
            $user = $auth->get_user();
            $movies = $movieModel->favorites($user['id']);

            $this->send_json_success(
                [
                    'status' => true,
                    'message' => (empty($movies)) ? 'Sua lista está vazia! Adicione um filme a sua lista de filmes favoritos' : 'Lista recuperada com sucesso',
                    'movies' => $movies
                ]
            );

        }catch(\Exception $e){

            $this->send_json_error('Houve um erro ao tentar recuperar sua lista de filmes favoritos');
            
        }
        
    }

}