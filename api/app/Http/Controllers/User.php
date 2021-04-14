<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;

class User extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $v = Validator::make($request->only(['name', 'email', 'password']), [
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:users,email',
            'password' => 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*([^a-zA-Z\d\s])).{'
                    . env('PASSWORD_MIN_LENGTH') . ',' . env('PASSWORD_MAX_LENGTH') .
                '}$/'
        ]);

        if ($v->fails()) {
            return response($v->errors(), 400);
        }

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $client = Client::where('password_client', 1)->first();

        $request->request->add([
            'grant_type'    => 'password',
            'client_id'     => $client->id,
            'client_secret' => $client->secret,
            'username'      => $user->email,
            'password'      => $request->password,
            'scope'         => null,
        ]);

        return Route::dispatch(Request::create('oauth/token', 'POST'));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response);
            } else {
                $response = ["message" => "Credentials mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'Credentials mismatch'];
            return response($response, 422);
        }
    }
}
