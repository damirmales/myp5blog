<?php ob_start();
require_once('functions/functions.php');

?>
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('public/img/home-bg.jpg')">
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
if(!empty($registerFormMessage)){
    flashMessage($registerFormMessage);
}
if(!empty($_SESSION["registerForm"]["login"])){

    flashMessage2($_SESSION["registerForm"]["login"]);
    unset($_SESSION["registerForm"]["login"]);
}
if(!empty($_SESSION["registerForm"]["email"])){

    flashMessage2($_SESSION["registerForm"]["email"]);
    unset($_SESSION["registerForm"]["email"]);
}

if(!empty($_SESSION["registerForm"]["OK"])){

    flashMessage2($_SESSION["registerForm"]["OK"]);
    unset($_SESSION["registerForm"]["OK"]);
}
?>



    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <form action="index.php?route=addUser" method="post" name="registerForm" id="registerForm">
                    <input type="hidden" name="formRegister" value="sent">
                    <input type="hidden" name="role" value="member">
                    <input type="hidden" name="statut" value="0">

                    <div class="form-group">
                        <label for="nom">Nom </label>
                        <!-- <input type="text" class="form-control" id="nom" placeholder="Entrez le nom" name="nom" required> -->
                        <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom"
                               value="<?= getFormData('register', 'nom') ?>">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom"
                               value="<?= getFormData('register', 'prenom') ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">E-mail</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email"
                               value="<?= getFormData('register', 'email') ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputLogin">Login</label>
                        <input type="input" class="form-control" id="login" aria-describedby="login" name="login"
                               placeholder="Login" value="<?= getFormData('register', 'login') ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Mot de Passe</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Mot de passe"
                               name="password">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword2">Retapez votre Mot de Passe</label>
                        <input type="password" class="form-control" id="inputPassword2"
                               placeholder="répeter Mot de passe" name="password2">
                    </div>

                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </form>
            </div>
        </div>
    </div>

    <hr>

<?php $content = ob_get_clean(); ?>

<?php require 'templates/layout_gabarit.php'; ?>