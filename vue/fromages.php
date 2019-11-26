<?php ob_start(); ?>

   <!-- Blog Author -->
  <header class="masthead" style="background-image: url('public/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Blog de Damir M</h1>
            <span class="subheading">Liste des articles de fromages</span>
          </div>
        </div>
      </div>
    </div>
  </header>

<?php foreach ($rubriques as $article) : ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-preview">

            <a href="index.php?route=article&id=<?= $article['articles_id'] ?>">

            <h2 class="post-title">
              <?php echo htmlspecialchars($article['titre']); ?>
            </h2>
            <h3 class="post-subtitle">
             <?php echo  htmlspecialchars($article['chapo']); ?>
            </h3>
          </a>
  
      <p class="post-meta">Modifié le : 
            <?php echo  htmlspecialchars($article['date_mise_a_jour']); ?>
      </p>

      <p> Commentaire</p>


        </div>
        <hr>
    <a href="vue/article.php?id=<?= $article['articles_id'] ?>">Voir l'article</a>
    <a href="delete-article.php?id=<?= $article['articles_id'] ?>" onclick="return window.confirm(`Êtes vous sur de vouloir supprimer cet article ?!`)">Supprimer</a>
  </div>
  </div>
  </div>

<?php endforeach ?>

  <?php $content = ob_get_clean();?>


<?php require'templates/layout_gabarit.php'; ?>