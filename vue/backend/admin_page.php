
<?php ob_start(); ?>
    <!-- Main Content -->
<div class="container">
<div class="row">
<div class="col-lg-8 col-md-10 mx-auto">
        <p>Articles </p>
        <p><ul>
          <li><a href="index.php?route=createArticle" >Créer un article</a></li>
        <li><a href="index.php?route=editListArticles" >Afficher les articles</a></li>
        <li><a href="index.php?route=editArticle" >Editer un article</a></li>
      </ul>
    </p>
</div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <p>Commentaires</p>
        <ul>
          <li><a href="index.php?route=editComment" >Editer un commentaire</a></li>
        <li><a href="index.php?route=supprComment" >Supprimer un commentaire</a></li>
      </ul>
    </div>
</div>
</div>
  <hr>

<?php $content = ob_get_clean();?>

<?php require'templates/layout_backend.php'; ?>