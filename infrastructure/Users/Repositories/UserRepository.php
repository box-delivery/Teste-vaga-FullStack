<?php

namespace Infrastructure\Users\Repositories;

use Domain\Users\User;
use Illuminate\Database\Eloquent\Model;
use Infrastructure\Shared\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->firstOrFail();
    }

    public function findBookmarksByUser(User $user)
    {
        return $user->bookmarks;
    }
}