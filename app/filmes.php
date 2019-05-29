<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class filmes extends Model
{
    protected $table='filmes';
    protected $fillable=['nome','sinopse','imagem','ano','generos_id',''];

    //public $pastaImagens="http://localhost/testeEmprego/storage/app/public/imagens/";
    

    public function Generos(){
        return $this->belongsTo('App\genero');
    }


    public function Like(){
        return $this->hasMany('App\user_filme','filme_id');
        ///return $this->hasMany('App\cadastro','cargo_id');
    }
}
