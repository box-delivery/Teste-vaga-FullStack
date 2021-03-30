<?php

namespace App\Models;

use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserFavoriteMovie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'movie_id'
    ];

    /**
     * Get the movie associated.
     */
    public function movie()
    {
        return $this->hasOne(Movie::class, 'id', 'movie_id');
    }

    /**
     * Get the movie associated.
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
