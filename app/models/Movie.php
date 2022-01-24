<?php 

namespace App\Models;

use App\Clients\TheMovieDB;
use DB\DB;

class Movie
{
    public function popular_movies( array $args = [] )
    {

        try{

            $api = new TheMovieDB();

            return $api->popular_movies($args);

        }catch(\Exception $e) {

            return false;
        }
        
    }

    public function get( $movie_id )
    {
        try{

            $api = new TheMovieDB();

            return $api->movie($movie_id);

        }catch(\Exception $e) {

            return false;
        }
    }

    public function import( $movie_id )
    {
        try{

            $db = new DB();
            $api = new TheMovieDB();

            $movie = $db->select(
                'movies', 
                'movie_id', 
                [
                    'movie_id' => $movie_id
                ]
            );

            if ($movie) {
                return true;
            }

            if (!$movie=$this->get($movie_id)) {
                return false;
            }

            $result = $db->insert(
                'movies', 
                [
                    'movie_id' => $movie->id,
                    'title' => $movie->title
                ]
            );

            return true;

        }catch(\Exception $e) {

            return false;
        }
    }

    public function favorites( $user_id )
    {
        $db = new DB();

        $result = $db->query(
            "SELECT 
                <movies>.* 
            FROM 
                <favorites> 
                JOIN <movies> ON <movies>.<movie_id> = <favorites>.<movie_id>
            WHERE 
                <user_id> = $user_id"
        );

        $movies = $result->fetchAll(\PDO::FETCH_ASSOC);

        return $movies;
    }
}