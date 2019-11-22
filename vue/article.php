  <?php ob_start(); ?>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('public/img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1><?= $article['titre'] ?></h1>
            <h2 class="subheading"><?= $article['chapo'] ?></h2>
            <span class="meta">Posté par 
              <a href="#"><?= $article['auteur'] ?></a>
              <br>
            Le <?= $article['date_creation'] ?></span>
          </div>
        </div>
      </div>
    </div>
  </header>


  <!-- Article Content -->
  <article>
    <div class="container">
        <p>Contenu : </p>
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
        
            <p><?= $article['contenu'] ?><!-- $article-> -->

          </p>         
        </div>
      </div>
    </div>
  </article>

  <hr>
  <!-- Comment form -->
  <div class="container">
    <p>Ajouter un commentaire<br/>
    <span>Vous devez vous enregistrer pour poster un commentaire</span><br/>
    <a href="index.php?route=register"> S'enregistrer</a></p>
     <a href="index.php?route=connexion"> Se connecter</a></p>

    
  </div>

  <!-- display comments  a mettre dans la methode du FrontendController-->


<?= $allComments; ?>


  <?php $content = ob_get_clean();?>


  <?php require'templates/layout_gabarit.php'; ?>