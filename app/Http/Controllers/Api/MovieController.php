<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Models\SyncRelations;
use App\Http\Controllers\Controller;
use App\Models\Movies;
use App\Response\Error;
use App\Response\Success;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class UsersController
 * @package App\Http\Controllers\Api
 */
class MovieController extends Controller
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Movies
     */
    protected $model;

    /**
     * @param Request $request
     * @param Movies $movie
     */
    public function __construct
    (
        Request $request,
        Movies $model
    )
    {
        $this->request = $request;
        $this->model = $model;
        $this->request["model"] = $this->model;
    }

    /**
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function index($paginate=20)
    {
        $list = $this->model->paginate($paginate);
        return Success::generic(
            $list, messageSuccess(50000, "Lista de Filmes mostrada com sucesso!"),
            "api"
        );
    }

    /**
     * @param $movie_id
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function favorite($movie_id)
    {
        $movie = Movies::find($movie_id);
        $user = auth("api")->user();
        $contains = $movie->users->contains($user->id);
        if(!$contains)
        {
            $movie->users()->attach($user->id);
            return Success::generic(
                $movie,
                messageSuccess(30001, "Filme adicionado a lista de Favoritos!"),
                "api"
            );
        }
        else
        {
            return Error::generic(
                null,
                messageErrors(4003, "Filme já está adicionado a lista de Favoritos"),
                "api"
            );
        }
    }

    public function deleteFavorite($movie_id)
    {
        $movie = Movies::find($movie_id);
        $user = auth("api")->user();
        $contains = $movie->users->contains($user->id);
        if($contains)
        {
            $movie->users()->detach($user->id);
            return Success::generic(
                $movie,
                messageSuccess(30001, "Filme retirado a lista de Favoritos!"),
                "api"
            );
        }
        else
        {
            return Error::generic(
                null,
                messageErrors(4003, "Filme já está retirar a lista de Favoritos"),
                "api"
            );
        }
    }

    /**
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function listFavorite()
    {
        $list = auth("api")->user()->favorites()->orderBy("title", "ASC")->paginate(20);
        return Success::generic($list, messageSuccess(20004, "Favoritos"), "api");
    }

}
