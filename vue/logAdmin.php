<?php use Services\Messages;

ob_start();

?>
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('public/img/about-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1>login page admin</h1>
                        <span class="subheading">accès aux admins</span>
                        <a class="nav-link" href="index.php">Accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

<?php
if (!empty($connexionErrorMessage)) {
    Messages::flashMessage($connexionErrorMessage);
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
                        <input type="input" class="form-control" id="login" name="login" aria-describedby="login"
                               placeholder="Votre login">

                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="password"
                               placeholder="Votre mot de passe">
                    </div>

                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </form>
            </div>
        </div>
    </div>
    <hr>
<?php $content = ob_get_clean(); ?>
<?php require 'templates/layout_gabarit.php'; ?>