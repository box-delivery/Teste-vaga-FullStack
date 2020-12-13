<?php


namespace App\Services;


use App\Models\User;

class UserService
{

    /** @var User */
    private $model;

    /**
     * UserService constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }


    /**
     * @param array $data
     *
     * @return User
     */
    public function createOne(array $data): User
    {
        $user = $this->model->newInstance();
        $user->fill($data);
        $user->save();

        return $user;

    }

}
