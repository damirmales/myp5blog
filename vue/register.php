<?php
require_once('functions/functions.php');
?>
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



  <!-- Page Header -->
  <header class="masthead" style="background-image: url('public/img/about-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Page d'inscription</h1>
            <span class="subheading">membre ou admin</span>
            <a class="nav-link" href="index.php">Accueil</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <?php
  //============== mettre dans une classe Messages / warning ============
  if (!empty($registerFormMessage))
  {
?>
   <br/><div class="container alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    ☝ <strong>Attention! </strong><br>
      <?php
    foreach ($registerFormMessage as $err)
    {

      echo $err.'<br/>';
    }
    echo '</div>';
  } 
  ?>

  <?php
  //============== mettre dans une classe Messages / success ============
  if (!empty($_SESSION["registerFormOK"]))
  {

    echo '<br/><div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Bravo! </strong>'
    .$_SESSION["registerFormOK"].'</div>';
  }
  ?>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
       <form action="index.php?route=registerForm" method="post" name="registerForm" id="registerForm">
        <input type="hidden" name="formRegister" value="sent">
        <div class="form-group">
          <label for="nom">Nom </label>
          <!-- <input type="text" class="form-control" id="nom" placeholder="Entrez le nom" name="nom" required> -->
          <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom"
          value="<?= getFormData('register','nom') ?>">
        </div>
        <div class="form-group">
          <label for="prenom">Prénom</label>
          <input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom"
          value="<?= getFormData('register','prenom') ?>">
        </div>
        <div class="form-group">
          <label for="inputEmail">E-mail</label>
          <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="<?= getFormData('register','email') ?>">
        </div>
        <div class="form-group">
          <label for="inputLogin">Login</label>
          <input type="input" class="form-control" id="login" aria-describedby="login" name="login" placeholder="Login" value="<?= getFormData('register','login') ?>">
        </div>
        <div class="form-group">
          <label for="inputPassword">Mot de Passe</label>
          <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" >
        </div>
        <div class="form-group">
          <label for="inputPassword2">Retapez votre Mot de Passe</label>
          <input type="password" class="form-control" id="inputPassword2" placeholder="re Password" name="password2" >
        </div>

        <button type="submit" class="btn btn-primary" >Soumettre</button>
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
