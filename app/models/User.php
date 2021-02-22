<?php

namespace App\Models;

use DB\DB;

class User
{
    /**
     * Find user by token function
     *
     * @param string $token
     * @return object/false
     */
    public function findByToken( string $token )
    {
        $db = new DB();
        if ($user = $db->select('users', '*', ['token' => $token])) {
            return current($user);
        }

        return false;
    }

}