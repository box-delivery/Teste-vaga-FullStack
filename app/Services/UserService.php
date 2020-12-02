<?php


namespace App\Services;


use App\Exceptions\UserAlreadyRegisteredException;
use App\Models\User;
use App\Repositories\User as UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Create a new user
     * @param $name
     * @param $email
     * @param $password
     * @return User
     * @throws UserAlreadyRegisteredException if email already in use
     */
    public function createUser($name, $email, $password)
    {
        $this->checkEmailNotInUse($email);

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();

        return $user;
    }

    /**
     * @param $email
     * @return bool true if email not in use
     * @throws UserAlreadyRegisteredException
     */
    public function checkEmailNotInUse($email)
    {
        $user = $this->userRepository->getUserByEmail($email);

        if ($user !== null) {
            throw new UserAlreadyRegisteredException('User already registered');
        }

        return true;
    }

}
