<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    public $pastaImagens=  "http://localhost/testeEmprego/storage/app/public/imagens/";/***pasta das imagens***/
    public $apiLogin    =  "http://localhost/testeEmprego/public/api/auth/login";/***endereço da api de login**/
    public $urlCAd      =  "http://localhost/testeEmprego/public/api/auth/registro";/***Endereço da api de cadastro**/
    public $Redirect    =  "http://localhost/testeEmprego/public/";/*Essa Url serve para redirecionar a página após o cadastro*/
    public $Favoritar   =  "http://localhost/testeEmprego/public/api/filmes/favoritar";/**endereço da Api que vai marcas ors filmes como favoritos**/
    public $ApiFilmes   =  "http://localhost/testeEmprego/public/api/filmes";/*****endereço da api que vai me entregar os filmes***/
    public $MeusFav     =  "http://localhost/testeEmprego/public/api/filmes/favoritos/";//***api que vai me entregar os filmes que eu gostei*/


}
