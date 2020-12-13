<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavoriteMovies extends Model
{
    use HasFactory;


    public const TABLE_ALIAS = 'fm';
    public const TABLE_NAME = 'user_favorite_movies';

    public const FIELD_USER_ID = 'user_id';
    public const FIELD_MOVIE_ID = 'movie_id';

    protected $table = self::TABLE_NAME;
    protected $fillable = [
        'user_id',
        'movie_id'
    ];
}
