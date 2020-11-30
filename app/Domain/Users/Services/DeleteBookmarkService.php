<?php

namespace App\Domain\Users\Services;

use Domain\Bookmarks\Bookmark;
use Illuminate\Support\Facades\DB;
use Infrastructure\Bookmarks\Repositories\BookmarkRepository;

class DeleteBookmarkService
{
    private BookmarkRepository $bookmarkRepository;

    public function __construct(BookmarkRepository $bookmarkRepository)
    {
        $this->bookmarkRepository = $bookmarkRepository;
    }

    public function __invoke(string $id)
    {
        DB::transaction(function () use ($id) {
            $bookmark = $this->bookmarkRepository->deleteBookmarksById($id);
        });
    }
}