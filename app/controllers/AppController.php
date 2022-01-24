<?php 

namespace App\Controllers;

class AppController
{

    public function send_json( $data = [], $http_code = 200 )
    {
        header('Content-type: application/json');
        http_response_code($http_code);

        echo json_encode($data);
    }

    public function send_json_success( $data = [] )
    {
        return $this->send_json($data, 200);
    }

    public function send_json_error( $data = [], $http_code = 400 )
    {
        return $this->send_json(
            [
                'status' => false,
                'message' => $data
            ], 
            $http_code 
        );
    }
}