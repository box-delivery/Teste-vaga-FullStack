<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    protected $fillable = [
    	'codigo', 'nome', 'sinopse', 'genero', 'imagem'
    ];
}
