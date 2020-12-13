<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DataTables;
use App\User;

class HomeController extends Controller
{
    private $objuser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->objuser = new User();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        return view('home');
    }

    public function search()
    {                      
        $users = $this->objuser->all();
               
        $ret = $this->getApi('https://api.themoviedb.org/3/genre/movie/list');
        $dados = $ret["genres"];
     
        return view('admin.pages.search.index', compact('dados'));
    }

    public function getApi($api, $param = '') {

        $key = 'b93368c54aa313b891141c951f7fbe0d';

        $client = new Client();
        
        $response = $client->request('GET', ''.$api.$param.'?api_key='.$key.'&language=pt-BR');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $ret = json_decode($body, true);
        return $ret;
    }

    public function searchTerm(Request $request) {              
        
        $genero = ($request->query('genero') != '') ? $request->query('genero'): '1';
        $retMovies = $this->getApi('https://api.themoviedb.org/3/list/', $genero);

        $responseImg = $this->getApi('https://api.themoviedb.org/3/configuration');
        

        $pathImg = $responseImg["images"]["base_url"].$responseImg["images"]["backdrop_sizes"][0];        

        $response = array();
       
        foreach ($retMovies['items'] as $result) {                       
            $elements = array(
                    "name" => $result['original_title'], 
                    "description" => $result['overview'],
                    "image" => $pathImg.$result["backdrop_path"],
                    "language" => $result['original_language']
                );
            array_push($response, $elements);
        }

        if ($request->ajax()) {
            return DataTables::of($response)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" id="buttonLocalizar" class="edit btn btn-info btn-sm" onclick="cadastrar()"><i class="fa fa-heart" aria-hidden="true"></i> Favorito</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $ret = $this->getApi('https://api.themoviedb.org/3/genre/movie/list');
        $dados = $ret["genres"];

        return view('admin.pages.search.index', compact('dados'));
    }
}
