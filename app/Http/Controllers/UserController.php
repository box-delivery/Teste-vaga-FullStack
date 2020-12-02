<?php


namespace App\Http\Controllers;


use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserController
{

    public function create(CreateUserRequest $request)
    {
        $data = $request->all();

        $userService = new UserService();
        $userService->createUser($data['name'], $data['email'], $data['password']);

        return Response::json([
            'message' => 'User created successfully',
        ]);
    }

}
