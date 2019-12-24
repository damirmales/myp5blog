<?php ob_start(); ?>



   <!-- Blog Author -->
  <header class="masthead" style="background-image: url('public/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Blog de Damir M</h1>
              <span class="subheading">Liste des articles</span>
          </div>
        </div>
      </div>
    </div>
  </header>

<?php
/******************************** gestion des messages selon les renseignements des formulaires ***********
 * //************* mettre dans une classe Messages / success **********************
 * /*****************************************************************************/

if (!empty($_SESSION["userMember"]))
{
    flashMessage2($_SESSION["userMember"]);
}
unset($_SESSION["userMember"]);
?>

<?php foreach ($articles as $article) : ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-preview">
            <h2 class="post-title">
           <a href="index.php?route=article&id=<?= $article->getArticles_id() ?>">   <?php echo htmlspecialchars($article->getTitre()); ?>       </a>
            </h2>
            <h3 class="post-subtitle">
             <?php echo  htmlspecialchars($article->getChapo()); ?>
            </h3>
  
      <p class="post-meta">Modifié le : 
            <?php echo  htmlspecialchars($article->getDate_mise_a_jour()); ?>
      </p>

        </div>
     
    <a href="index.php?route=article&id=<?= $article->getArticles_id() ?>">Voir l'article</a><br>
    <!--<a href="delete-article.php?id=<?= $article->getArticles_id()  ?>" onclick="return window.confirm(`Êtes vous sur de vouloir supprimer cet article ?!`)">Supprimer</a>-->
       <hr>
  </div>
  </div>
  </div>
<?php endforeach ?>
  <?php $content = ob_get_clean();?>

<?php require'templates/layout_gabarit.php'; ?>