<?php
/*use Services\Session;
require_once 'services/Session.php';
$_SESSION['famille']['nom']='toto';
  $session = new Session($_SESSION);
$session->set('famille','nom','gaston');
  print_r($session->get('famille','nom')) ;
*/

use Services\Collection;
require_once 'services/Collection.php';

$_SESSION['famille']['nom'] = 'toto';
$session = new Collection($_SESSION['famille']);
print_r($session);

