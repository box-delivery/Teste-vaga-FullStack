<?php

namespace App\Models;

use App\Models\UserFavoriteMovie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $hidden = ["created_at", "updated_at"];

    public function userFavorites()
    {
        return $this->hasMany(UserFavoriteMovie::class);
    }
}
