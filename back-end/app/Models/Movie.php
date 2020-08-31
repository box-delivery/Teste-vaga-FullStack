<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'codigo',
        'title',
        'release_date',
        'original_title',
        'overview',
        'poster_path'
    ];

    public function favorite()
    {
        return $this->hasOne(Favorites::class, 'movie_id', 'id')->where('user_id', auth()->id());
    }

}
