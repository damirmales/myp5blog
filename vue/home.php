<?php ob_start();
use Services\Collection;

//require_once('services/Collection.php');
if (array_key_exists('input', $_SESSION))
{
    $session = new Collection($_SESSION['input']);
}



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

                    if (isset($_SESSION['registerFormOK'])) {
                        echo $_SESSION['registerFormOK'];
                        unset($_SESSION['registerFormOK']);
                    }

                    if(!empty($contactErrorMessage)){
                        flashMessage($contactErrorMessage);
                    }

                    if(!empty($registerMessage)){
                        flashMessage($registerMessage);
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
                                       value="<?= $session->getKey('nom');//getFormData('input', 'nom') ?>">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="form-group floating-label-form-group controls">
                            <label>Prénom </label>
                            <input type="text" class="form-control" placeholder="Prénom " name="prenom" id="prenom"
                                   required data-validation-required-message="Entrez votre prénom"
                                   value="<?= $session->getKey('prenom'); ?>">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>


                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                                    data-validation-required-message="Entrez votre email."
                                   value="<?= $session->getKey('email'); ?>"  required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Message</label>
                            <textarea rows="5" class="form-control" placeholder="Message" name="message" id="message"
                                      required data-validation-required-message="Entrez votre message."
                                      value="<?= $session->getKey('message'); ?>"></textarea>
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
<?php $content = ob_get_clean();?>


<?php require 'templates/layout_gabarit.php'; ?>