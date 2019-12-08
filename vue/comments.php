<?php ob_start();  ?>

 <div class="container">

     <?php
     if (($_SESSION['user']['role'] === 'member') || ($_SESSION['user']['role'] === 'admin'))
     {
         echo $formComment; // affiche le formulaire pour commenter
     }
     else
     {
         ?>
         <p> Pour commenter un article vous devez vous enregistrer et/ou vous connecter</p>
         <p>➢<a href="index.php?route=register" class""> s'enregistrer</a></p>
         <p>➢<a href="index.php?route=connexion" class""> se connecter</a></p>
    <?php
     }

     ?>

<p>Commentaires</p>
<?php

  foreach ($comments as $comment)
  {
    ?>

    <!-- Comment Content -->
    <article>

        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <p><strong>Rédigé par <?= htmlspecialchars($comment['pseudo']) ?></strong></p>
            <p>le <?= $comment['date_ajout'] ?></p>

            <p>Commentaire</p>
            <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>       

        </div>
      </div>
    </article>

  <?php } ?>

  <hr>

<?php $allComments = ob_get_clean();?>
</div>
  <?php require'vue/article.php'; ?>
