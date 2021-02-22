<?php 

namespace App\Controllers;

use DB\DB;

/**
 * CreateAccountController class
 * 
 * @package App\Controllers
 */
class CreateAccountController extends AppController
{

    /**
     * Undocumented function
     *
     * @return void
     */
    public function create()
    {
        $db = new DB();

        extract($_POST);

        //email is valid
        if (!validEmail($email)) {
            return $this->send_json_error("E-mail inválido");
        }

        //email exists
        $already_exists = $db->select('users', 'email', ['email' => $email]);

        if ($already_exists) {
            return $this->send_json_error("E-mail já cadastrado. Tente fazer login", 200);
        }
        
        $result = $db->insert(
            'users', 
            [
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ]
        );

        if (!$result->rowCount()) {
            return $this->send_json_error("Não foi possível criar sua conta, tente novamente mais tarde", 500);
        }

        $this->send_json_success(
            [
                'status' => true,
                'message' => 'Conta criada com sucesso! Tente fazer login'
            ]
        );
    }

}