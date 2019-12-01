  <?php ob_start(); ?>

  <!-- Article Content -->
  <article>
    <div class="container">
      
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
                  <div class="post-heading">
            <h1><?= $article->getTitre(); ?></h1>
            <h2 class="subheading"><?= $article->getChapo(); ?></h2>
            <span class="meta">Posté par 
              <a href="#"><?= $article->getAuteur(); ?></a>
              <br>
            Le <?= $article->getDate_creation(); ?></span>
          </div>
            <p>Contenu : </p>
            <p><?= $article->getContenu(); ?><!-- $article-> -->
            <p><a href="admin.php?route=deleteArticle&id=<?= $article->getArticles_id(); ?>" onclick="return window.confirm(`Êtes vous sur de vouloir supprimer cet article ?!`)">Supprimer</a></p>
          </p>         
        </div>
      </div>
    </div>
  </article>

  <hr>


  <?php $content = ob_get_clean();?>


  <?php require'templates/layout_backend.php'; ?>