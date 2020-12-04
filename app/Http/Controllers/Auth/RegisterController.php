<?php

namespace App\Http\Controllers\Auth;

use App\DTO\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response as Response;
use App\Models\User;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $data = new UserData($request->validated());
        $user = User::createFromDTO($data);

        return response([
            'token' => $user->createToken('spa')->plainTextToken,
            'user' => new UserResource($user)
        ], Response::HTTP_CREATED) ;
    }
}
