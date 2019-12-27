
<?php ob_start();
$titre = "Tableau de bord";
?>
    <!-- Main Content -->
<div class="container">
<div class="row">
<div class="col-lg-8 col-md-10 mx-auto">
        <p><strong> Articles </strong></p>
        <p><ul>
          <li><a href="index.php?route=createArticle" >Créer un article</a></li>
        <li><a href="index.php?route=editListArticles" >Afficher les articles</a></li>

      </ul>
    </p>
</div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <p><strong>Commentaires</strong></p>
        <ul>
         <li><a href="index.php?route=listComments" >Liste des commentaires</a></li>

      </ul>
    </div>
</div>
</div>
  <hr>

<?php $content = ob_get_clean();?>

<?php require'templates/layout_backend.php'; ?>