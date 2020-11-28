<?php

namespace App\Domain\Users\Services;

use Domain\Users\User;
use Illuminate\Support\Facades\DB;
use Infrastructure\Users\Repositories\UserRepository;

class CreateUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(array $data)
    {
        $user = new User($data);

        DB::transaction(function () use ($user) {
            $this->userRepository->persist($user);
        });

        return $user;
    }
}