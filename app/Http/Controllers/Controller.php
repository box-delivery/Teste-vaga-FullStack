<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $key = "8eac538070fb63bfed846f40daca622d";
    private $apiUrl = "https://api.themoviedb.org/3/movie/";

    protected function requestAPI($url)
    {
        $headers = ['Content-Type: application/x-www-form-urlencoded; charset=utf-8'];

        $endUrl = $this->apiUrl . $url . "?api_key=" . $this->key;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endUrl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output);
    }
}
