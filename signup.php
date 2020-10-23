<?php
require_once( 'auth/Auth.php' );
$auth = new Auth();
$googleClient = $auth->googleLogin();

// authenticate code from Google OAuth Flow
if ( isset($_GET['code']) ) {
    session_start();
    $token = $googleClient->fetchAccessTokenWithAuthCode( $_GET['code'] );
    $googleClient->setAccessToken( $token['access_token'] );
    $_SESSION['access_token'] = $token['access_token'];

    // print_r($googleClient);
    
    // get profile info
    $google_oauth = new Google_Service_Oauth2($googleClient);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;

    // print_r($google_oauth);

    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;

    header( "Location:" . filter_var( $_SERVER['HTTP_HOST'] . 'newspaper.php' , FILTER_SANITIZE_URL ) );

} if ( isset($_REQUEST['logout']) ){
    session_start();
    unset($_SESSION['access_token']);
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    session_destroy();
    //$googleClient->revokeToken();
    header( "Location: index.php" );
}