<?php

namespace App\TheMovieDB;

class AuthMovies
{
    public static function authRequestToken(string $token, string $url, string $method)
    {
        $curl = curl_init();
        $headers = array(
            "authorization: Bearer $token",
            "content-type: application/json;charset=utf-8"
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER       => true,
            CURLOPT_ENCODING             => "",
            CURLOPT_MAXREDIRS            => 10,
            CURLOPT_TIMEOUT              => 0,
            CURLOPT_FOLLOWLOCATION       => true,
            CURLOPT_HTTP_VERSION         => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST        => $method,
            CURLOPT_POSTFIELDS           => "{\"redirect_to\":\"http://www.themoviedb.org/\"}",
            CURLOPT_HTTPHEADER           => $headers,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $return = json_decode($response, true);
        return $return;
    }

    public static function authAccessToken(string $token, string $request_token, string $url, string $method)
    {
        $curl = curl_init();
        $headers = array(
            "authorization: Bearer $token",
            "content-type: application/json;charset=utf-8"
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER       => true,
            CURLOPT_ENCODING             => "",
            CURLOPT_MAXREDIRS            => 10,
            CURLOPT_TIMEOUT              => 0,
            CURLOPT_FOLLOWLOCATION       => true,
            CURLOPT_HTTP_VERSION         => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST        => $method,
            CURLOPT_POSTFIELDS           => "{\"request_token\":\"$request_token\"}",
            CURLOPT_HTTPHEADER           => $headers,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $return = json_decode($response, true);
        return $return;
    }

}
