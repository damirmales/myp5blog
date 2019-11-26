<?php ob_start(); 

 foreach ($articlesEdited as $article) : ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-preview">


            

            <h2 class="post-title">
           <a href="index.php?route=article&id=<?= $article['articles_id'] ?>">   <?php echo htmlspecialchars($article['titre']); ?>       </a>
            </h2>

            <h3 class="post-subtitle">
             <?php echo  htmlspecialchars($article['chapo']); ?>
            </h3>
   
  
      <p class="post-meta">Modifié le : 
            <?php echo  htmlspecialchars($article['date_mise_a_jour']); ?>
      </p>
   
      <p> Commentaire</p>


        </div>
     
    <a href="index.php?route=article&id=<?= $article['articles_id'] ?>">Voir l'article</a><br>
    <a href="index.php?route=deleteArticle&id=<?= $article['articles_id'] ?>" onclick="return window.confirm(`Êtes vous sur de vouloir supprimer cet article ?!`)">Supprimer</a>
       <hr>
  </div>
  </div>
  </div>

<?php endforeach ?>

<?php $content = ob_get_clean();
require'templates/layout_backend.php'; 

