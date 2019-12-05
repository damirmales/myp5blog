  <!DOCTYPE html>
  <html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="auteur" content="">

    <title>Damir Blog - formulaire pour administrateur</title>

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

   

<!-- Page Header -->
<header class="masthead" style="background-image: url('public/img/about-bg.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="page-heading">
          <h1>login page</h1>
          <span class="subheading">accès aux membres et admins</span>
          <a class="nav-link" href="index.php">Accueil</a>
        </div>
      </div>
    </div>
  </div>
</header>

 <?php
 //============== mettre dans une classe Messages / warning ============
 if (!empty($connexionErrorMessage)){

          echo '<br/><div class="container alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          ☝ <strong>Attention! </strong>';
          foreach ($connexionErrorMessage as $err) {

            echo $err.'<br/>';
          }
          echo '</div>';
        } 
        ?>


<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
     <form action="index.php?route=pageAdmin" method="post" name="loginForm" id="loginForm">
         <input type="hidden" name="formLogin" value="sent">
      <div class="form-group">
        <label for="inputLogin">Login</label>
        <input type="input" class="form-control" id="login" name="login" aria-describedby="login" placeholder="Votre login">
     
      </div>
      <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Votre mot de passe">
      </div>
  
      <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
  </div>
</div>
</div>

<hr>

<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <ul class="list-inline text-center">
          <li class="list-inline-item">
            <a href="#">
              <span class="fa-stack fa-lg">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
              </span>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#">
              <span class="fa-stack fa-lg">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
              </span>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#">
              <span class="fa-stack fa-lg">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-github fa-stack-1x fa-inverse"></i>
              </span>
            </a>
          </li>
        </ul>
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