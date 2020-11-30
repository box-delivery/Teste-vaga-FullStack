<?php

namespace Infrastructure\Bookmarks\Repositories;

use Domain\Bookmarks\Bookmark;
use Illuminate\Database\Eloquent\Model;
use Infrastructure\Shared\Repositories\AbstractRepository;

class BookmarkRepository extends AbstractRepository
{
    public function __construct(Bookmark $bookmark)
    {
        $this->model = $bookmark;
    }

    public function persist(Model $model): Model
    {
        if ($model->movie_id !== null) {
            $model->bookmarks()->attach($model->movie_id);
        }

        return $model;
    }

    public function deleteBookmarksById(string $id)
    {
        Bookmark::find($id)->delete();
    }
}