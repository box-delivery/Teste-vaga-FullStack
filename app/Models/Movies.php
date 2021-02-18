<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'title',
        'original_title',
        'adult',
        'language',
        'original_language',
        'overview',
        'release_date',
        'poster_path'
    ];

    public function favorites()
    {
        return $this->belongsTo(Favorites::class, 'id', 'movie_id');
    }
}
