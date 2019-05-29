<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Config;
use Illuminate\Support\Facades\Auth;
use App\Events\EventNovoRegistro;

class AutenticadorControlador extends Controller
{
    
     public function index(Config $Config){
        $ApiLogin = $Config->apiLogin; 
        return view('movies.login',compact('ApiLogin') );
     } 

     public function cadastro(Config $Config){
        $ApiCad = $Config->urlCAd; 
        $redirect = $Config->Redirect; 
        return view('movies.cadastro',compact('ApiCad','redirect'));
     }

    public function registro(Request $request) {
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        
        $user = new User([
            'name'=> $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'token' => str_random(60)
        ]);
        $user->save();
        
        event(new EventNovoRegistro($user));

        return response()->json([
            'res'=>'Usuario criado com sucesso',
             'cod'=>201
        ], 201);
    }




    public function login(Request $request) {
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $credenciais = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credenciais))
            return response()->json([
                'res' => 'Acesso negado'
            ], 401);
        
        $user = $request->user();
        $token = $user->createToken('Token de acesso')->accessToken;

        return response()->json([
            'token' => $token,
            'AuthId'=>$user->id
        ], 200);
    }





    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json([
            'res' => 'Deslogado com sucesso'
        ]);
    }




    public function ativarregistro($id, $token) {
        $user = User::find($id);
        if ($user) {
            if ($user->token == $token) {
                $user->active = true;
                $user->token = '';
                $user->save();
                return view('registroativo');
            }
        }
        return view('registroerro');
    }

}
