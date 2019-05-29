<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\genero;

class generoCtrl extends Controller
{
    public function cria(genero $genero, Request $Request){
       $all = $genero->all(); 
       return view('movies.adm.criaGenero',compact('all'));
    }


    public function CriaGenero(genero $genero, Request $Request){
        $genero->create($Request->all());
        return redirect('filmes/generos');
    }
}
