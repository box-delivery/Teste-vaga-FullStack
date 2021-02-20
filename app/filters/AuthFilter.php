<?php

namespace App\Filters;

use App\Controllers\AppController;
use App\Models\User;

class AuthFilter{


    /**
     * Main function to validate Bearer Token Request
     *
     * @return void
     */
    public function validate()
    {
        $token = $this->getBearerToken();

        if ( ! $token ) {
            $this->unauthorizedResponse();
            return false;
        }

        $userModel = new User();
        $user = $userModel->findByToken( $token );

        if ( ! $user ) {
            $this->unauthorizedResponse();
            return false;
        }

        return true;
    }

    /**
     * Private function to send unauthorized response to client
     *
     * @return void
     */
    private function unauthorizedResponse()
    {
        $app = new AppController();
        $app->send_json_error('401 Unauthorized', 401);
    }

    /**
     * Private function to return BearerToken from Request
     *
     * @return void
     */
    private function getBearerToken() 
    {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    /**
     * Function to get Authorization Headers from Request
     *
     * @return void
     */
    private function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }

        return $headers;
    }

}