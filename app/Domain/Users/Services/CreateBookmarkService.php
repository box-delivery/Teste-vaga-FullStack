<?php

namespace App\Domain\Users\Services;

use Domain\Users\User;
use Illuminate\Support\Facades\DB;
use Infrastructure\Bookmarks\Repositories\BookmarkRepository;

class CreateBookmarkService
{
    private BookmarkRepository $bookmarkRepository;

    public function __construct(BookmarkRepository $bookmarkRepository)
    {
        $this->bookmarkRepository = $bookmarkRepository;
    }

    public function __invoke(array $data)
    {
        $user = auth()->user();
        $user->movie_id = $data['movie_id'];

        $existMovie = $this->existUserBookmark($user);

        if ($existMovie) {
            return;
        } 
        
        DB::transaction(function () use ($user) {
            $this->bookmarkRepository->persist($user);
        });

        return $user;
    }
    public function existUserBookmark(User $user)
    {
        $exist = false; 

        $userMovie = $user->bookmarks->map(function ($movie) use($user, &$exist) {
            if ($movie->id === $user->movie_id) {
                $exist = true;
            }
        });

        return $exist;
    }
}