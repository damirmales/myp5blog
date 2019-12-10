  <?php ob_start();
  require_once('functions/functions.php');

  ?>
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('public/img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1><?= $article->getTitre() ?></h1>
            <h2 class="subheading"><?= $article->getChapo(); ?></h2>
            <span class="meta">Posté par 
              <a href="#"><?= $article->getAuteur(); ?></a>
              <br>
            Le <?= $article->getDate_creation(); ?></span>
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
        
            <p><?= $article->getContenu(); ?><!-- $article-> -->

          </p>         
        </div>
      </div>
    </div>
  </article>

  <hr>
  <!-- Comment form -->
  <div class="container">
    <p>Ajouter un commentaire<br/>




  </div>

  <!-- display comments  a mettre dans la methode du FrontendController-->

<?= $allComments; // Comments container?>

  <?php $content = ob_get_clean();?>

  <?php require'templates/layout_gabarit.php'; ?>