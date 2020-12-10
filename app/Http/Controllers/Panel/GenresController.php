<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Genres;
use App\Response\Error;
use App\Response\Success;
use Illuminate\Http\Request;

class GenresController extends Controller
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * RoleController constructor.
     * @param Request $request
     */
    public function __construct
    (
        Request $request
    )
    {
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable|Mixed
     */
    public function list()
    {
        $list = [];
        $genres = Genres::all();
        foreach ($genres as $genre)
        {
            if($genre->movies->count() > 0)
            {
                $list[] = $genre;
            }
        }
        $data = [
            "list" => $list
        ];
        if($list)
        {
            return Success::generic($data, messageSuccess(30001, "Lista de Gêneros"), "api");
        }
        return Error::generic(null, messageErrors(4003, "Erro ao mostrar lista de Gêneros"), "api");
    }
}
