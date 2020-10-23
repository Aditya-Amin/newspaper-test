<?php

/**
 * This class is for authentications
 * 
 */


 class Auth {



    // google login credentials returing the client obejct
    public function googleLogin(){
        require_once( dirname(__DIR__) . '/vendor/autoload.php' );
        // init configuration
        $clientID = '';
        $clientSecret = '';
        $redirectUri = 'https://glacial-fjord-18098.herokuapp.com/signup.php';
        
        // create Client Request to access Google API
        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");

        return $client;
    }
 }