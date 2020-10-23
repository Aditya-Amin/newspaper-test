<?php

require_once( 'auth/Auth.php' );
$auth = new Auth();
$auth->googleLogin();