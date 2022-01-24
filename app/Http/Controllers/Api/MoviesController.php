<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\Movies;

class MoviesController extends Controller
{

    use ApiResponser;
    
    public function list()
    {
        $hasMovies = Movies::count();

        if ($hasMovies == 0) {
            return $this->error('Nenhum filme cadastrado',202);
        }

        $moviesList['movies'] = Movies::get(['id', 'title', 'language', 'overview', 'release_date', 'poster_path', 'adult']);

        return $this->success($moviesList, 'Success', 200);

    }
}
