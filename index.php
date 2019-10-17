<?php
// to display the error message
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';


require_once('Router.php');



$router = new \Router();
$router->run();

