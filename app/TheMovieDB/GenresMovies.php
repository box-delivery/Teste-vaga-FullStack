<?php

namespace App\TheMovieDB;

use phpDocumentor\Reflection\Types\Integer;

class GenresMovies
{
    public static function genres(string $token, string $url, string $method, string $language)
    {
        $curl = curl_init();
        $headers = array(
            "Content-Type"  => "application/json;charset=utf-8",
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url."?api_key=".$token."&language=$language",
            CURLOPT_RETURNTRANSFER       => true,
            CURLOPT_ENCODING             => "",
            CURLOPT_MAXREDIRS            => 10,
            CURLOPT_TIMEOUT              => 0,
            CURLOPT_FOLLOWLOCATION       => true,
            CURLOPT_HTTP_VERSION         => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST        => $method,
            CURLOPT_POSTFIELDS           => [],
            CURLOPT_HTTPHEADER           => $headers,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $return = json_decode($response, true);
        return $return;
    }
}
