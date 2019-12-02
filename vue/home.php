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
        if (!empty($contactErrorMessage)){

          echo '<br/><div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          ☝ <strong>Attention! </strong>';
          foreach ($contactErrorMessage as $err) {

            echo $err.'<br/>';
          }
          echo '</div>';
        } 
        ?>

        <?php 

        if (!empty($_SESSION["contactFormOK"]))
        {

          echo '<br/><div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Bravo! </strong>'
          .$_SESSION["contactFormOK"].'</div>';
        }
        /*else
        {echo('messageSend'.$_SESSION["contactFormOK"]);
          echo '<br/><div class="alert alert-warning ">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Attention! </strong>'
          .$_SESSION["contactFormOK"].'</div>';

        }  */

        ?>
        <!-- Contact Form -  -->

        <form action="index.php?route=contact" method="post" name="sentMessage" id="contactForm" novalidate>
          <input type="hidden" name="formContact" value="sent">
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Prénom </label>
              <input type="text" class="form-control" placeholder="Prénom " name="prenom" id="prenom" required data-validation-required-message="Entrez votre prénom" value="<?= getFormData('input','prenom') ?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>

          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Nom</label>
              <input type="text" class="form-control" placeholder="Nom" name="nom"  id="nom" required data-validation-required-message="Entrez votre nom." value="<?= getFormData('input','nom') ?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>

          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Email</label>
              <input type="email" class="form-control" placeholder="Email" name="email"  id="email" required data-validation-required-message="Entrez votre email." value="<?= getFormData('input','email') ?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>

          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Message</label>
              <textarea rows="5" class="form-control" placeholder="Message" name="message"  id="message" required data-validation-required-message="Entrez votre message."value="<?=  getFormData('input','message') ?>"></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>

          <br>
          <div id="success"></div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" id="sendMessageButton" name="valider">Envoyez</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <hr>
  <?php $content = ob_get_clean();
 
  ?> 


  <?php require 'templates/layout_gabarit.php'; ?>