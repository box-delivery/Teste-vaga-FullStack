<?php


namespace App\Services;

use App\DTO\UserData;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private Builder $query;

    public function __construct()
    {
        $this->query = User::query();
    }

    public function create(UserData $data): User
    {
        $user = $this->query->make($data->toArray());
        $user->password = Hash::make($data->password);
        $user->save();

        return $user;
    }
}
