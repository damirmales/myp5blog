<?php ob_start(); ?>


  <?php

  foreach ($comments as $comment)
  {
    ?>

    <!-- Comment Content -->
    <article>
      <div class="container">
        
  <p>Commentaires</p>
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <p><strong>Rédigé par <?= htmlspecialchars($comment['pseudo']) ?></strong></p>
            <p>le <?= $comment['date_ajout'] ?></p>

            <p>Commentaire</p>
            <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>       
          </div>
        </div>
      </div>
    </article>


  <?php } ?>

  <hr>

<?php $allComments = ob_get_clean();?>

  <?php require'vue/article.php'; ?>
