<?php 

namespace App\Controllers;

use App\Filters\AuthFilter;
use App\Models\Favorite;
use App\Models\Movie;
use Exception;

/**
 * AddToFavoriteController class
 */
class AddToFavoriteController extends AppController
{

    /**
     * Main function
     *
     * @return Response
     */
    public function index()
    {
        try{

            $movie_id = $_GET['movie_id'];

            $movieModel = new Movie();

            $movie = $movieModel->import($movie_id);

            if (!$movie) {
                throw new \Exception('Não foi possível favoritar este filme');
            }

            $auth = new AuthFilter();
            $user = $auth->get_user();

            $favorite = new Favorite();
            $favorite->save(
                [
                    'user_id'  => $user['id'],
                    'movie_id' => $movie_id
                ]
            );

            $this->send_json_success(
                [
                    'status' => true,
                    'message' => 'Adicionado aos favoritos com sucesso'
                ]
            );

        }catch( \Exception $e ){

            $this->send_json_error($e->getMessage());
        }
    }
}