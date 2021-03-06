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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet " type="text/css">

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
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="index.php"> Damir Males</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?route=liste">Tous les articles</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">Rubriques</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php?route=livres">Livres</a>
                        <a class="dropdown-item" href="index.php?route=fromages">Fromages</a>
                        <!--<a class="dropdown-item" href="index.php?route=autres">Autres</a>-->
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?route=cv">CV</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?route=contact">Contact</a>
                </li>
                <?php
                $session = &$_SESSION;
                if (isset($session['user']['role'])) {
                    ?>
                    <li class="nav-item">
                    <?php if ($session['user']['role'] === 'admin') { ?>
                        <a class="nav-link" href="index.php?route=admin">⚒ Admin</a>
                    <?php } else { ?>
                        <span class="menu_member"> ☑ Membre </span>

                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?route=deconnexion">ⓓ Déconnexion </a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?route=register">ⓔ S'enregistrer </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?route=connexion">ⓒ Se connecter </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<?php echo $content; ?>


<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="https://twitter.com/damirmn">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://www.facebook.com/profile.php?id=100012201365725">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://github.com/damirmales/myp5blog/">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
                        </a>
                    </li>
                </ul>
                <?php
                if (isset($session_role)) {

                if ($session_role != 'admin') {
                ?>
                <p class="admin text-center"><a href="index.php?route=connexionAdmin">⚒ Administration</a>
                    <?php
                    }
                    }
                    ?>

                <p class="copyright text-muted">Copyright &copy; Damir Blog 2020</p>
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
