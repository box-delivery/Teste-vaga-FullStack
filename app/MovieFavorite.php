<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieFavorite extends Model
{
    protected $table = 'movies_favorites';

    protected $fillable = [
        'user_id',
        'movie_id'
    ];

    public $timestamps = false;
}
