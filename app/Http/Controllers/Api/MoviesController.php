<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Validator;

use App\Models\Movie;

use Illuminate\Http\Request;

class MoviesController extends Controller
{

    /**
     * Index (Get List)
     *
  	 * @param  int $start
     * @param  int $limit
     */
	public function index(Request $request) {

		$start 	= $request->start ?: 0;
		$limit 	= $request->limit ?: 5;

		$movies = Movie::offset($start)->limit($limit)->get();

		return $this->resp(true, ['results' => $movies]);

	}

    /**
     * store create (PUT)
     *
 	 * @param  int $page
     */
	public function store(Request $request) {

		try {

			// Verifica se DbKey está cadastrada
			if( !env('MovieDbKey') )
				return $this->resp(false, 'configure your MovieDbKey in .env file');

			$page 		= $request->page > 0 ? $request->page : 1;
			$endpoint 	= env('MovieDbUrl') . 'popular';

			// Captura os filmes via Curl Get
			$client = new \GuzzleHttp\Client([
			    'verify' => false
			]);

			$response = $client->request('GET', $endpoint, [
				'query' => [
					'api_key' 	=> env('MovieDbKey'),
					'page' 		=> $page
				]
			]);			    

			// Se sucesso, popula o banco de dados
			if( $response->getStatusCode() == 200 ) {

				$movies 	= $response->getBody()->getContents();
				$movies 	= json_decode( $movies )->results;

				// Popula banco se filme ainda não foi cadastrado
				foreach ($movies as $movie):
					$newMovie 	= Movie::firstOrNew(['external_id' => $movie->id]);
					$newMovie->original_title		= $movie->original_title;
					$newMovie->original_language	= $movie->original_language ?? false;
					$newMovie->poster_path 			= $movie->poster_path ?? false;
					$newMovie->overview 			= $movie->overview ?? false;
					$newMovie->vote_average 		= $movie->vote_average ?? false;
					$newMovie->save();
				endforeach;

				return $this->resp(true, 'import completed successfully');
				    
			} return $this->resp(false, 'error to import movies');

        } catch (\Exception $e) {

        	return $this->resp(false, $e->getMessage());

        }

	}

}