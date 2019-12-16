<?php ob_start();
$titre = "Liste des articles";

 foreach ($articlesEdited as $article) : ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-preview">

            <h2 class="post-title">
           <a href="index.php?route=showArticle&id=<?= $article->getArticles_id() ?>">   <?php echo htmlspecialchars($article->getTitre()); ?>
       </a>
            </h2>

            <h3 class="post-subtitle">
             <?php echo  htmlspecialchars($article->getChapo()); ?>
            </h3>

      <p class="post-meta">Modifié le : 
            <?php echo  htmlspecialchars($article->getDate_mise_a_jour()); ?>
      </p>

        </div>
     
    <a href="index.php?route=showArticle&id=<?= $article->getArticles_id() ?>">Voir l'article</a><br>
      <hr>
  </div>
  </div>
  </div>

<?php endforeach ?>

<?php $content = ob_get_clean();
require'templates/layout_backend.php'; 

