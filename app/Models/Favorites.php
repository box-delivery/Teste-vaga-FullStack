<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_id',
        'is_favorite'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function movie()
    {
        return $this->belongsTo(Movies::class, 'movie_id', 'id');
    }
}
