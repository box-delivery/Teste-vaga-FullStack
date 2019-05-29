<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_filme extends Model
{
    protected $table="user_filmes";
    protected $fillable=['user_id','filme_id','like'];


    public function FilmesPai(){ return $this->belongsTo('App\filmes','filme_id');  }

    
    /*public function Emails(){
        return $this->belongsToMany('App\emails','cadastro_emails','cadastro_id','id');
        //return $this->belongsToMany('modelo cujo os dados estou atras', 'tabela mista', 'id do cadastro da tabela de intersecção', 'id do email da tabela de intersecção');
    }*/
    
}
