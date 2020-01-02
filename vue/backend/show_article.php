<?php ob_start();
$titre = "Un article";

use Services\Messages; ?>
<!-- Article Content -->
<article>
    <div class="container">
        <?php

        if (isset($_SESSION['updateArticle'])) {
            Messages::flashMessage2($_SESSION['updateArticle']);
            unset($_SESSION['updateArticle']);
        }
        ?>
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1><?= $article->getTitre(); ?></h1>
                    <h2 class="subheading"><?= $article->getChapo(); ?></h2>
                    <span class="meta">Posté par
              <a href="#"><?= $article->getAuteur(); ?></a>
              <br>
            Le <?= $article->getDate_creation(); ?></span>
                </div>
                <p>Contenu : </p>
                <p><?= $article->getContenu(); ?><!-- $article-> -->
                <p><a href="index.php?route=deleteArticle&id=<?= $article->getArticles_id(); ?>"
                      onclick="return window.confirm(`Êtes vous sur de vouloir supprimer cet article ?!`)">Supprimer</a>
                </p>
                <p><a href="index.php?route=editArticle&id=<?= $article->getArticles_id(); ?>"> Modifier</a></p>
                <p><a href="index.php?route=editListArticles "> Liste des articles</a></p>
            </div>
        </div>
    </div>
</article>

<hr>
<?php $content = ob_get_clean(); ?>
<?php require 'templates/layout_backend.php'; ?>