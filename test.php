<?php
use Services\Session;
require_once 'services/Session.php';
$_SESSION['famille']['nom']='toto';
  $session = new Session($_SESSION);
$session->set('famille','nom','gaston');
  print_r($session->get('famille','nom')) ;

