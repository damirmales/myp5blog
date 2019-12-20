<?php
  use Services\Collection;

  $_SESSION['famille']['nom']='toto';
  $session = new Collection($_SESSION['famille']['nom']);
  echo $session;

?>
