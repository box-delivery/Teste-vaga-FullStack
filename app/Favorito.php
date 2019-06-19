<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $fillable = [
    	'filme_id','user_id'
    ];

    public function filme() {
        return $this->BelongsTo('App\Filme');
    }

    public function user() {
        return $this->BelongsTo('App\User');
    }
}
