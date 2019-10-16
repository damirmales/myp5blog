<?php ob_start(); ?>

   <!-- Page Header -->
   <header class="masthead" style="background-image: url('../public/img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1><?= $article['titre'] ?></h1>
            <h2 class="subheading"><?= $article['chapo'] ?></h2>
            <span class="meta">Posted by
              <a href="#">Start Bootstrap</a>
            on August 24, 2019</span>
          </div>
        </div>
      </div>
    </div>
  </header>


  <!-- Article Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <p>
            <?= $article['contenu'] ?>

          </p>         
        </div>
      </div>
    </div>
  </article>

  <hr>
  <p>Commentaires</p>


  <?php
          //while ($dataComment = $comment->fetch())
  foreach ($comments as $comment)
  {
    ?>

    <!-- Comment Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <p><strong>Rédigé par <?= htmlspecialchars($comment['commentaire_id']) ?></strong></p>
            <p>le <?= $comment['date_ajout'] ?></p>

            <p>Commentaire</p>
            <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>       
          </div>
        </div>
      </div>
    </article>


  <?php } ?>

  <hr>

<?php $content = ob_get_clean();?>


<?php require('templates/layout_gabarit.php'); ?>