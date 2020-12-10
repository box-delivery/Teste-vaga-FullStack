<?php

namespace App\Models;

use App\Observers\InterceptObserversModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Movies
 * @package App\Models
 */
class Movies extends Model
{
    /**
     * @var string
     */
    protected $table = 'movies';

    /**
     * @var array
     */
    protected $fillable = [
        "themoviedb_id",
        "adult",
        "backdrop_path",
        "original_language",
        "original_title",
        "overview",
        "popularity",
        "poster_path",
        "release_date",
        "title",
        "video",
        "vote_average",
        "vote_count",
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
                    "adult"                => ['required'],
                    "backdrop_path"        => ['required'],
                    "original_language"    => ['required'],
                    "original_title"       => ['required'],
                    "overview"             => ['required'],
                    "popularity"           => ['required'],
                    "poster_path"          => ['required'],
                    "release_date"         => ['required'],
                    "title"                => ['required'],
                    "video"                => ['required'],
                    "vote_average"         => ['required'],
                    "vote_count"           => ['required'],*/
                ],
        ];
    /**
     * End validations =================================================================================================
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(\App\Models\Genres::class, 'movies_genres', 'themoviedb_movie_id', 'themoviedb_genre_id')->withoutGlobalScopes();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(\App\User::class, 'favorites_movies', 'movie_id', 'user_id')->withoutGlobalScopes();
    }

}
