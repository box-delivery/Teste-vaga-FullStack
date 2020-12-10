<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Genres;
use App\Models\Movies;
use App\Response\Error;
use App\Response\Success;
use App\TheMovieDB\ListMovies;
use App\TheMovieDB\Tokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MoviesController extends Controller
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
    public function index()
    {
        return view($this->request->route()->getName());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable|Mixed
     */
    public function list($genre_id)
    {
        if($genre_id==="not")
        {
            $list = Movies::
                orderBy("original_title", "ASC")
                ->with("users")
                ->paginate(40);
        }
        else
        {
            $list = Genres::find($genre_id)->movies()
                ->orderBy("original_title", "ASC")
                ->with("users")
                ->paginate(40);
        }
        $data = [
            "list" => $list
        ];
        if($list)
        {
            return Success::generic($data, messageSuccess(30001, "Lista de Filmes"), "api");
        }
        return Error::generic(null, messageErrors(4003, "Erro ao mostrar lista de Filmes"), "api");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable|Mixed
     */
    public function search()
    {
        if($this->request->search!=null)
        {
            $list = Movies::orWhere("original_title", "like", "%".$this->request->search."%")
                ->orWhere("overview", "like", "%".$this->request->search."%")
                ->orderBy("original_title", "ASC")
                ->with("users")
                ->paginate(40);
        }
        else
        {
            $list = Movies::
                orderBy("original_title", "ASC")
                ->with("users")
                ->paginate(40);
        }
        $data = [
            "list" => $list
        ];
        if($list)
        {
            return Success::generic($data, messageSuccess(30001, "Lista de Filmes"), "api");
        }
        return Error::generic(null, messageErrors(4003, "Erro ao mostrar lista de Filmes"), "api");
    }

    /**
     * @param int $page
     * @param string $language
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function listPopular($page=1, $language="pt-BR")
    {
        $apiKey = Tokens::apiKey();
        $data = array(
            "api_key"   => "{$apiKey}",
            "url"       => "https://api.themoviedb.org/3/movie/popular",
            "method"    => "GET",
            "page"      => $page,
            "language"  => $language
        );
        $validation  = Validator::make($data,
            [
                "api_key"   => ["required"],
                "url"       => ["required"],
                "method"    => ["required"],
                "page"      => ["required"],
                "list_id"   => ["required"],
                "language"  => ["required"],
            ]
        );
        if($validation->fails())
        {
            return Error::generic(
                $validation->errors(),
                messageErrors(4003, "Atenção aos erros de Validação"),
                "api"
            );
        }
        $response = ListMovies::listPopular(
            $data["api_key"],
            $data["url"],
            $data["method"],
            $data["language"],
            1
        );
        if(isset($response["results"]) && count($response["results"]) > 0)
        {
            return Success::generic(
                $response,
                messageSuccess(30001, "Lista de Filmes Carregada Com Sucesso!"),
                "api"
            );
        }
        return Error::generic(
            null,
            messageErrors(4003, "Não Foi Possível Carregar Lista de Filmes"),
            "api"
        );
    }

    /**
     * Update on List Movies Popular
     */
    public function updateListMoviesPopular()
    {
        $apiKey = Tokens::apiKey();
        $listPopularCountPages = ListMovies::listPopular(
            "{$apiKey}",
            "https://api.themoviedb.org/3/movie/popular",
            "GET",
            "pt-BR",
            1
        );
        for ($i=1;$i<=$listPopularCountPages["total_pages"];$i++)
        {
            $listPopular = ListMovies::listPopular(
                "{$apiKey}",
                "https://api.themoviedb.org/3/movie/popular",
                "GET",
                "pt-BR",
                $i
            );
            if(isset($listPopular["results"]) && count($listPopular["results"]) > 0)
            {
                foreach ($listPopular["results"] as $movie)
                {
                    $movieCreate = Movies::create([
                        "themoviedb_id"         => $movie["id"] ?? null,
                        "adult"                 => $movie["adult"] ?? null,
                        "backdrop_path"         => $movie["backdrop_path"] ?? null,
                        "original_language"     => $movie["original_language"] ?? null,
                        "original_title"        => $movie["original_title"] ?? null,
                        "overview"              => $movie["overview"] ?? null,
                        "popularity"            => $movie["popularity"] ?? null,
                        "poster_path"           => $movie["poster_path"] ?? null,
                        "release_date"          => $movie["release_date"] ?? null,
                        "title"                 => $movie["title"] ?? null,
                        "video"                 => $movie["video"] ?? null,
                        "vote_average"          => $movie["vote_average"] ?? null,
                        "vote_count"            => $movie["vote_count"] ?? null,
                    ]);
                    $movieCreate->genres()->sync(array_values($movie["genre_ids"]), true);
                }
            }
        }
    }

    public function favorite($movie_id)
    {
        $movie = Movies::find($movie_id);
        $user = auth()->user();
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
        $user = auth()->user();
        $contains = $movie->users->contains($user->id);
        if($contains)
        {
            $movie->users()->detach($user->id);
            return Success::generic(
                $movie,
                messageSuccess(30001, "Filme retirado a lista de Favoritos!"),
                "web",
                route("panel.movie.favoriteList")
            );
        }
        else
        {
            return Error::generic(
                null,
                messageErrors(4003, "Filme já está retirar a lista de Favoritos"),
                "web",
                route("panel.movie.favoriteList")
            );
        }
    }

    public function info($movie_id)
    {
        $movie = Movies::find($movie_id);
        $data = [
            "movie" => $movie
        ];
        if($movie!=null)
        {
            return Success::generic(
                $data,
                messageSuccess(30001, "Informações do Filme Mostradas com successo!"),
                "api"
            );
        }
        else
        {
            return Error::generic(
                null,
                messageErrors(4003, "Erro ao Mostrar informações do Filme"),
                "api"
            );
        }
    }

    public function favoriteList()
    {
        $list = auth()->user()->favorites()->paginate(20);
        return view($this->request->route()->getName(), compact("list"));
    }

}
