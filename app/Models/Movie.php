<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public const TABLE_ALIAS = 'mv';
    public const TABLE_NAME = 'movies';

    public const FIELD_ID = 'id';

    protected $table = 'movies';
    protected $fillable = [
        'title',
        'overview',
        'poster_url',
        'rating'
    ];
}
