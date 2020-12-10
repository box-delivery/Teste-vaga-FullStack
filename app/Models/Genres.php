<?php

namespace App\Models;

use App\Observers\InterceptObserversModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Genres
 * @package App\Models
 */
class Genres extends Model
{
    /**
     * @var string
     */
    protected $table = 'genres';

    /**
     * @var array
     */
    protected $fillable = [
        'themoviedb_id',
        'name',
        'description',
    ];

    /**
     * Start validations ===============================================================================================
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(new InterceptObserversModel);
    }

    /**
     * The attributes in validations.
     *
     * @var array
     */
    public static $rules =
        [
            "creating"                     =>
                [
                    /*'model'                => ['required'],
                    'themoviedb_id'        => ['required'],
                    'name'                 => ['required'],*/
                ],
        ];
    /**
     * End validations =================================================================================================
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function movies()
    {
        return $this->belongsToMany(\App\Models\Movies::class, 'movies_genres', 'themoviedb_genre_id', 'themoviedb_movie_id')->withoutGlobalScopes();
    }

}
