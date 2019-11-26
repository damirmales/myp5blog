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
        
            <p><?= $article['contenu'] ?>

          </p>         
        </div>
      </div>
    </div>
  </article>

  <hr>
  <!-- Comment form -->
  <div class="container">
    <p>Ajouter un commentaire</p>

    <form action="index.php?route=addComment&id=<?= $article['articles_id'] ?>" method="post">
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="Nom" placeholder="" value="" required name="nom">
      </div>
     <!-- <div class="form-group">             
        <label for="email">Email :</label>
        <input type="email" class="form-control" id="email">
      </div>
      -->
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Votre commentaire</span>
        </div>
        <textarea class="form-control" aria-label="With textarea" name="comment"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

  </div>

  <!-- display comments -->

  <?php use Controller\FrontendController;
  $frontComment = new FrontendController();

  $frontComment=$frontComment->getComments($id); 
  ?>
  <hr>

  <?php $content = ob_get_clean();?>


  <?php require'templates/layout_gabarit.php'; ?>