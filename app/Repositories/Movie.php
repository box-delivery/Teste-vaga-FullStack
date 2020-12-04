<?php


namespace App\Repositories;


use App\Models\Movie as MovieModel;

class Movie
{

    /**
     * @param $id
     * @return MovieModel|null
     */
    public function getMovieById($id)
    {
        return MovieModel::find($id);
    }

}
