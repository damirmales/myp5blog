
<?php ob_start(); ?>

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
      <div class="col-lg-8 col-md-10 mx-auto">
        <p>Vous êtes dans le blog de Damir Males.
    <br/>Vous avez un projet de site web?, alors vous êtes au bon endroit contactez-moi</p>
        <!-- Contact Form - Enter your email address on line 19 of the file to make this form work. -->
       
        <form name="sentMessage" id="contactForm" novalidate>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Prénom</label>
              <input type="text" class="form-control" placeholder="Prénom" id="surname" required data-validation-required-message="Entrez votre prénom.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
      
      <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Nom</label>
              <input type="text" class="form-control" placeholder="Nom" id="name" required data-validation-required-message="Entrez votre nom.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
      
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Email</label>
              <input type="email" class="form-control" placeholder="Email" id="email" required data-validation-required-message="Entrez votre email.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
      
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Message</label>
              <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Entrez votre message."></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
      
          <br>
          <div id="success"></div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Envoyez</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <hr>
  <?php $content = ob_get_clean();?>


<?php require('templates/layout_gabarit.php'); ?>