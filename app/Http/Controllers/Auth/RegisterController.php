<?php

namespace App\Http\Controllers\Auth;

use App\DTO\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Response as Response;

class RegisterController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function store(RegisterRequest $request)
    {
        $data = new UserData($request->validated());
        $user = $this->service->create($data);

        return response([
            'token' => $user->createToken('spa')->plainTextToken,
            'user' => new UserResource($user)
        ], Response::HTTP_CREATED) ;
    }
}
