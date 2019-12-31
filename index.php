<?php
session_start();
/*use Services\Session;

$newSession = new Session($_SESSION);

if (!$newSession->get('user','role'))
{
    echo 'pas de newSession';
}
*/

/*if (!isset($_SESSION['user']['role'])) {
    $_SESSION['user']['role'] = null ;
}*/

// to display the error message
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';
require_once 'Router.php';
$router = new \Router();
$router->run();

