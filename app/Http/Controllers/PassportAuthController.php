<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PassportAuthController extends Controller
{

    /** @var UserService */
    private $userService;

    /**
     * PassportAuthController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function register(Request $request): JsonResponse
    {
        $this->validate($request, [
            User::FIELD_NAME => 'required',
            User::FIELD_EMAIL => 'required|email|unique:users',
            User::FIELD_PASSWORD => 'required'
        ]);

        $user = $this->userService->createOne([
            User::FIELD_NAME => $request->name,
            User::FIELD_EMAIL => $request->email,
            User::FIELD_PASSWORD => bcrypt($request->password)
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);

    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {

        $data = [
            User::FIELD_EMAIL => $request->email,
            User::FIELD_PASSWORD => $request->password
        ];


        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;

            return response()->json([
                'token' => $token
            ], 200);

        } else {
            return response()->json([
                'error' => 'Access Denied'
            ], 401);
        }

    }
}
