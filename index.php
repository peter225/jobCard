<?php

// server should keep session data for AT LEAST 6 hours
ini_set('session.gc_maxlifetime', 24*60*60 );

session_save_path( 'app/sessions' );

ini_set('session.gc_probability', 1 );

ini_set( 'session.gc_divisor', 100 );

//each client should remember their session id for EXACTLY 6 hours
session_set_cookie_params( 24*60*60 );

session_start();

//ini_set('date.timezone', 'Africa/Lagos');

require_once 'app/main/app.php';

$app = new App;