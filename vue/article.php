<?php ob_start();

?>
<!-- Page Header -->
<header class="masthead" style="background-image: url('public/img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">

                    <h2 class="subheading"><span class="subheading">Article : <?= $article->getTitre(); ?></span></h2>

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
                <div class="post-heading">
                    <span class="meta"> <strong>Titre :</strong></span>
                    <h1><?= $article->getTitre() ?></h1>
                    <span class="meta"><strong>Châpo :</strong></span>
                    <h2 class="subheading"><?= $article->getChapo(); ?></h2>
                    <span class="meta"> <strong>Posté par : </strong>
              <a href="#"><?= $article->getAuteur(); ?></a>
              <br>
            <strong> Posté le : </strong><?= $article->getDate_creation(); ?></span>
                </div>

                <p><strong>Contenu : </strong></p>
                <p><?= $article->getContenu(); ?></p>
            </div>
        </div>
    </div>
</article>

<!-- Comment form -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

        </div>
    </div>
</div>


<!-- display comments  a mettre dans la methode du FrontendController-->
<?= $allComments; // Comments container ?>

<?php $content = ob_get_clean(); ?>
<?php require 'templates/layout_gabarit.php'; ?>