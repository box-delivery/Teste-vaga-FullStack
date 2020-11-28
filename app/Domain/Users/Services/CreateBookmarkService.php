<?php

namespace App\Domain\Users\Services;

use Domain\Users\User;
use Illuminate\Support\Facades\DB;
use Infrastructure\Users\Repositories\UserRepository;
use Infrastructure\Movies\Repositories\MovieRepository;

class CreateBookmarkService
{
    private UserRepository $userRepository;
    private MovieRepository $movieRepository;

    public function __construct(UserRepository $userRepository, MovieRepository $movieRepository)
    {
        $this->userRepository = $userRepository;
        $this->movieRepository = $movieRepository;
    }

    public function __invoke(array $data)
    {
        $user = auth()->user();
        $user->movie = $data['movie'];

        $existMovie = $this->existUserBookmark($user);

        if ($existMovie) {
            return;
        } 
        
        DB::transaction(function () use ($user) {
            $this->userRepository->persist($user);
        });

        return $user;
    }
    public function existUserBookmark(User $user)
    {
        $exist = false; 

        $userMovie = $user->bookmarks->map(function ($movie) use($user, &$exist) {
            if ($movie->id === $user->movie) {
                $exist = true;
            }
        });

        return $exist;
    }
}