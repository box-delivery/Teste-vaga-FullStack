<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use illuminate\support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|confirmed'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'error' => true,
                'message' => 'Dados para o registro inválidos'
            ], Response::HTTP_BAD_REQUEST, );

        }

        try {

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Usuário registrado com sucesso'
            ], Response::HTTP_OK);

        } catch(Exception $e) {

            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }

    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'error' => true,
                'message' => 'Credenciais inválidas'
            ], Response::HTTP_BAD_REQUEST);

        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)) {

            return response()->json([
                'error' => true,
                'message' => 'Acesso negado'
            ], Response::HTTP_UNAUTHORIZED);

        }

        try {

            $token = Str::random(60);

            $request->user()->forceFill([
                'api_token' => hash('sha256', $token)
            ])->save();

            return response()->json([
                'error' => false,
                'message' => 'Usuário logado',
                'token' => $token
            ], Response::HTTP_OK);

        } catch(Exception $e) {

            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->forceFill([
                'api_token' => null
            ])->save();

            return response()->json([
                'error' => false,
                'message' => 'Usuário deslogado'
            ], Response::HTTP_OK);

        } catch(Exception $e) {

            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }
}
