<?php ob_start();
require_once('functions/functions.php');
?>
    <!-- Blog Author -->
    <header class="masthead" style="background-image: url('public/img/home-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Blog de Damir M</h1>
                        <span class="subheading">Développeur PHP</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto"> <!-- mx-auto => margin:auto => permet de centrer -->
                <p>Vous êtes dans le blog de Damir Males.
                    <br/>Vous pouvez me contactez par ce formulaire</p>
                <?php
                if (!empty($contactErrorMessage)) {
                    flashMessage($contactErrorMessage);
                }
                if (!empty($contactSendMessage)) {
                    flashMessage2($contactSendMessage);
                }


                if (!empty($registerMessage)) {
                    flashMessage($registerMessage);
                }

                if (!empty($_SESSION["registerForm"]["OK"])) {
                    flashMessage2($_SESSION["registerForm"]["OK"]);
                    unset($_SESSION["registerForm"]["OK"]);
                }
                ?>
                <!-- Contact Form -  -->
                <form action="index.php?route=contactForm" method="post" name="sentMessage" id="contactForm" novalidate>
                    <input type="hidden" name="formContact" value="sent">
                    <div class="control-group">

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label>Nom</label>
                                <input type="text" class="form-control" placeholder="Nom" name="nom" id="nom" required
                                       data-validation-required-message="Entrez votre nom."
                                       value="<?= getFormData('input', 'nom') ?>">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="form-group floating-label-form-group controls">
                            <label>Prénom </label>
                            <input type="text" class="form-control" placeholder="Prénom " name="prenom" id="prenom"
                                   required data-validation-required-message="Entrez votre prénom"
                                   value="<?= getFormData('input', 'prenom') ?>">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                                   data-validation-required-message="Entrez votre email."
                                   value="<?= getFormData('input', 'email') ?>" required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Message</label>
                            <textarea rows="5" class="form-control" placeholder="Message" name="message" id="message"
                                      required data-validation-required-message="Entrez votre message."
                                      value="<?= getFormData('input', 'message') ?>"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>

                    <br>
                    <div id="success"></div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="sendMessageButton" name="valider">Envoyez
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
<?php $content = ob_get_clean(); ?>

<?php require 'templates/layout_gabarit.php'; ?>