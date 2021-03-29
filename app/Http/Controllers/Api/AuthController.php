<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Cadastra o usuário
     *
     * @param Request $request
     * @return json
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        try {
            DB::beginTransaction();
            $validatedData['password'] = bcrypt($request->password);

            $user = User::create($validatedData);

            $accessToken = $user->createToken('authToken')->accessToken;
            DB::commit();
            return response([ 'message' => 'Usuário criado com sucesso', 'user' => $user, 'access_token' => $accessToken]);
        } catch (Exception $e) {
            DB::rollback();
            Log::critical('Falha ao criar usuário: ' . $e);
            return response(['message' => 'Desculpe, algo deu errado :('], 500);
        }
    }

    /**
     * Gera o token de acesso
     *
     * @param Request $request
     * @return Json
     */
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        try {
            if (!auth()->attempt($loginData)) {
                return response(['message' => 'Dados inválidos'], 422);
            }

            auth()->user()->removeTokens();
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return response(['message' => 'Login efetuado com sucesso', 'user' => auth()->user(), 'access_token' => $accessToken]);
        } catch (Exception $e) {
            Log::critical('Erro no login: ' . $e);
            return response(['message' => 'Desculpe, algo deu errado :('], 500);
        }
    }
}
