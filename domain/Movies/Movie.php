<?php

namespace Domain\Movies;

use Domain\DomainModel;

class Movie extends DomainModel
{
    protected $fillable = [
        'id',
        'adult',
        'backdrop_path',
        'homepage',
        'external_id',
        'imdb_id',
        'original_language',
        'original_title',
        'overview',
        'popularity',
        'release_date',
        'runtime',
        'status',
        'tagline',
        'title',
        'video',
        'vote_count',
    ];

    protected $casts = [
        'adult' => 'boolean',
        'video' => 'boolean'
    ];
}
