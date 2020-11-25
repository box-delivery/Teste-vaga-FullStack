<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMovie extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'movie_id'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function movie() {
        return $this->belongsTo('App\Models\Movie', 'movie_id', 'id');
    }

}
