<?php


/**
 * Curl class for handling the API requests
 * HTTP request handler
 */


 class Curl {


    // HTTP GET request
    public static function get($url) {
        $_init_ = curl_init();
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => 1,
        ];

        curl_setopt_array($_init_, $options);
        $results = curl_exec($_init_);
        curl_close($_init_);

        return json_decode($results, true);
    }
 }