<?php

namespace App\TheMovieDB;

class SearchMovies
{
    public static function search(string $token, string $url, string $method, $query, $page=1, $include_adult=false)
    {
        $curl = curl_init();
        $headers = array(
            "Content-Type"  => "application/json;charset=utf-8",
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url."?api_key=".$token."&language=en-US&query=$query&page=$page&include_adult=$include_adult",
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

    public static function multiSearch(string $token, string $url, string $method, $query, $language, $page=1, $include_adult=false)
    {
        $curl = curl_init();
        $headers = array(
            "Content-Type"  => "application/json;charset=utf-8",
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url."?api_key=".$token."&language=$language&query=$query&page=$page&include_adult=$include_adult",
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
