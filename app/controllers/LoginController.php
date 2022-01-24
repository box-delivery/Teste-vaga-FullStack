<?php 

namespace App\Controllers;

use DB\DB;

class LoginController extends AppController
{

    public function authenticate()
    {
        $db = new DB();

        extract($_POST);

        if (!isset($email)) {
            return $this->send_json_error("Preencha o E-mail");
        }

        if (!isset($password)) {
            return $this->send_json_error("Preencha a Senha");
        }

        $user = $db->select('users', ['id', 'name', 'email', 'password'], ['email' => $email]);

        if (!$user) {
            return $this->send_json_error("Usuário ou Senha inválidos");
        }

        $user = current($user);
        
        if (!password_verify($password, $user['password'])) {
            return $this->send_json_error("Usuário ou Senha inválidos");
        }

        $token = hash('sha256', bin2hex(random_bytes(32)));

        $db->update(
            'users', 
            [
                'token' => $token
            ],
            [
                'id' => $user['id']
            ]
        );

        $this->send_json_success(
            [
                'status' => true,
                'message' => 'Login realizado com sucesso',
                'token' => $token
            ]
        );
    }

}