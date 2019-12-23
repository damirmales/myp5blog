<!DOCTYPE html>
  <html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="auteur" content="">

    <title>Damir Blog - admin </title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet' ?>" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="public/css/clean-blog.min.css" rel="stylesheet">

  </head>
  <body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
          <a class="navbar-brand" href="index.php">Damir Males</a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                  data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                  aria-label="Toggle navigation">
              Menu
              <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="index.php">Accueil du blog</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="index.php?route=admin">Tableau de bord</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="index.php?route=deconnexion">Se déconnecter</a>
                  </li>

              </ul>
          </div>
      </div>
  </nav>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('public/img/about-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="page-heading">
              <h1>Page d'administration du blog</h1>
              <span class="subheading"><?php echo $titre; ?></span>

            </div>
          </div>
        </div>
      </div>
    </header>


    <?php echo $content; ?>
      

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">

          <div class="col-lg-8 col-md-10 mx-auto">

              <p class="text-center" ><a  href="index.php?route=deconnexion">Se déconnecter</a></p>
              <p class="copyright text-muted">Copyright &copy; Your Website 2019</p>
          </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="public/js/clean-blog.min.js"></script>

</body>

</html>
