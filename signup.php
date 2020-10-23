<?php
require_once( '/vendor/autoload.php' );
// init configuration
$clientID = '464996402201-jeeonc4names3jc2heupok1n31idg19f.apps.googleusercontent.com';
$clientSecret = 'BdJ8pZyvjFIo5NVg4LbyYuBs';
$redirectUri = 'https://glacial-fjord-18098.herokuapp.com/signup.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow
if ( isset($_GET['code']) ) {
    session_start();
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $_SESSION['access_token'] = $token['access_token'];
    
    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;

    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    header( "Location newspaper.php" );
// now you can use this profile info to create account in your website and make user logged in.
} if ( isset($_REQUEST['logout']) ){
    session_start();
    unset($_SESSION['access_token']);
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    session_destroy();
    $client->revokeToken();
    header( "Location index.php" );
}