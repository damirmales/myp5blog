<?php
/*use Services\Session;
require_once 'services/Session.php';
$_SESSION['famille']['nom']='toto';
  $session = new Session($_SESSION);
$session->set('famille','nom','gaston');
  print_r($session->get('famille','nom')) ;
*/


use Services\Collection;
use Services\Session;
require_once 'services/Collection.php';
require_once 'services/Session.php';

$_SESSION['warning']['nom'] = 'toto';
$session = new Collection($_SESSION['famille']);
//echo 'Collection ';print_r($session);

$session2 = new Session($_SESSION);
//$session2->set('famille','nom','toto');
//echo 'Session2 ';print_r($session2->show('famille','nom'));

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="auteur" content="">
    <title>Damir Blog </title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet' ?>" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="public/css/clean-blog.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="public/css/clean-blog.min.css" rel="stylesheet">
    <!-- add personalized style.css -->
    <link href="public/css/styles.css" rel="stylesheet">
</head>
<body>

<div class="container alerte alert-<?=$_SESSION['warning'] ?>"><button type="button" class="close" data-dismiss="alert">&times;</button><?= $session2->show('famille','nom') ?>
</div>


<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">

                <div class="footer-social my-5">
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            <a class="footer-social-link d-inline-flex mx-3 justify-content-center align-items-center text-white rounded-circle shadow btn btn-github"
                               href="https://github.com/">
                                <i class="fab fa-github"></i>
                            </a>

                            <a class="footer-social-link d-inline-flex mx-3 justify-content-center align-items-center text-white rounded-circle shadow btn btn-twitter"
                               href="https://twitter.com/sbootstrap">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="footer-social-link d-inline-flex mx-3 justify-content-center align-items-center text-white rounded-circle shadow btn btn-facebook"
                               href="https://www.facebook.com/StartBootstrap/">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </div>
                    </div>
                </div>



                <p class="copyright text-muted">Copyright &copy; Damir Blog 2019</p>
            </div>
        </div>
    </div>
</footer>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="public/js/jqBootstrapValidation.js"></script>
<!-- <script src="public/js/contact_me.js"></script> -->

<!-- Custom scripts for this template -->
<script src="public/js/clean-blog.min.js"></script>

</body>

</html>