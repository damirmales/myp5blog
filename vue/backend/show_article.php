  <?php ob_start(); ?>

  <!-- Article Content -->
  <article>
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
            <p>Contenu : </p>
            <p><?= $article['contenu'] ?><!-- $article-> -->
            <p><a href="admin.php?route=deleteArticle&id=<?= $article['articles_id'] ?>" onclick="return window.confirm(`Êtes vous sur de vouloir supprimer cet article ?!`)">Supprimer</a></p>
          </p>         
        </div>
      </div>
    </div>
  </article>

  <hr>


  <?php $content = ob_get_clean();?>


  <?php require'templates/layout_backend.php'; ?>