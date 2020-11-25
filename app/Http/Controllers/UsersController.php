<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use \Firebase\JWT\JWT;

class UsersController extends Controller
{
    /**
     * Create (PUT)
     *
     * @param  \Illuminate\Http\Request  $request
     */
	public function create(Request $request) {

        $rules = [
            'name'              => 'required|max:50',
            'email'       		=> 'required|max:200|email|unique:users,email',
            'password'  		=> 'required|min:6',
        ];
        $validator = Validator::make($request->all(), $rules);

        // validator - laravel
        if ( $validator->fails() ) {

            return $this->resp(false, $validator->errors(), 400);

        } else {

        	// trata dados para inserir
        	$user 				= new User;
        	$user->name 		= ucfirst($request->name);
        	$user->email 		= strtolower( trim( $request->email ) );
        	$user->password 	= Hash::make($request->password);

        	if( $user->save() ) {
        		return $this->resp(true, $user);
        	} else return $this->resp(false, 'error to create a new user');

        }

	}

    /**
     * Login (POST)
     *
     * @param  \Illuminate\Http\Request  $request
     */
	public function login(Request $request) {

        $rules = [
            'email'       		=> 'required|max:200|email',
            'password'  		=> 'required|min:6',
        ];
        $validator = Validator::make($request->all(), $rules);

        // validator - laravel
        if ( $validator->fails() ) {

            return $this->resp(false, $validator->errors(), 400);

        } else {

        	$email 		= strtolower( trim( $request->email ) );

        	$user 		= User::where('email', $email)->first();

        	// se e-mail inválido, retorna erro ao usuário
        	if( !$user )
        		return $this->resp(false, 'user not found');        	    

        	// valida password
        	$checkPass	= Hash::check($request->password, $user->password);

        	if( !$checkPass )
				return $this->resp(false, 'password is wrong');

			// Gerar o bearer token e retorna dados
			$access_token 	= $this->jwt( $user->id );

    		return $this->resp(true, [
    			'access_token' 	=> $access_token,
    			'name' 			=> $user->name,
    			'email' 		=> $user->email
    		]);

        }

	}

    /**
     * Cria um novo token
     * 
     * @param  int $id
     * @return string
     */
    private function jwt($user_id) {

        $key            = env("APP_KEY");

        $payload        = [
            "iss"           => "php.test",
            "aud"           => "php.test",
            "sub"           => $user_id,
            "iat"           => time(),
            "exp"           => time() + (60 * 60 * 24 * 180),
        ];

        return JWT::encode($payload, $key);
        
    }

}