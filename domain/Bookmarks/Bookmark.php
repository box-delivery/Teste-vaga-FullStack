<?php

namespace Domain\Bookmarks;

use Domain\DomainModel;
use App\Domain\Shared\Traits\HasUuid;

class Bookmark extends DomainModel
{
    use HasUuid;

    protected $table = 'movie_user';

    protected $fillable = [
        'id',
        'user_id',
        'movie_id',
    ];
}
