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
        $clientID = '216558114057-mga0n3nj81k0pbcm6scr4813496pb8i9.apps.googleusercontent.com';
        $clientSecret = 'aTjGtYW1zZChY2iItPjUdbtN';
        $redirectUri = 'http://localhost/others/newspaper/signup.php';
        
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