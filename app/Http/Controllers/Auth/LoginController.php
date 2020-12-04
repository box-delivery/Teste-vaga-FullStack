<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated()) === false) {
            throw ValidationException::withMessages([
                'email' => Lang::get('auth.failed')
            ]);
        }

        $user = Auth::user();

        return response([
            'token' => $user->createToken('spa')->plainTextToken,
            'user' => new UserResource($user)
        ]);
    }
}
