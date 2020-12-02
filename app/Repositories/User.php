<?php


namespace App\Repositories;


use App\Models\User as UserModel;

class User
{

    /**
     * Returns an user or null if it doesn't exists
     * @param $email
     * @return UserModel|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getUserByEmail($email)
    {
        return UserModel::whereEmail($email)->first();
    }

}
