<?php


namespace App\Http\Controllers;


use App\Http\Requests\CreateUserRequest;
use App\Repositories\User as UserRepository;
use App\Services\UserService;
use Illuminate\Support\Facades\Response;

class UserController
{

    public function create(CreateUserRequest $request)
    {
        $data = $request->all();

        $userService = new UserService(new UserRepository());
        $userService->createUser($data['name'], $data['email'], $data['password']);

        return Response::json([
            'message' => 'User created successfully',
        ]);
    }

}
