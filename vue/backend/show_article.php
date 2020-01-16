<?php ob_start();
$titre = "Un article";

use Services\Messages;
use Services\Session;

$updateArticleMessage = new Session();

?>
    <!-- Article Content -->
    <article>
        <div class="container">
            <?php
            if (($updateArticleMessage->get('update', 'article')) != null) {
                Messages::flashMessage2($updateArticleMessage->get('update', 'article'));
                $updateArticleMessage->remove('update', 'article');
            }
            if (($updateArticleMessage->get('new', 'article')) != null) {
                Messages::flashMessage2($updateArticleMessage->get('new', 'article'));
                $updateArticleMessage->remove('new', 'article');
            }
            ?>
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1><?= htmlspecialchars($article->getTitre()) ?></h1>
                        <h2 class="subheading"><?= htmlspecialchars($article->getChapo()) ?></h2>
                        <span class="meta">Posté par
              <a href="#"><?= htmlspecialchars($article->getAuteur()) ?></a>
              <br>
            Le <?= htmlspecialchars($article->getDate_creation()) ?></span>
                    </div>
                    <p>Contenu : </p>
                    <p><?= htmlspecialchars($article->getContenu()) ?><!-- $article-> -->
                    <p><a href="index.php?route=deleteArticle&id=<?= htmlspecialchars($article->getArticles_id()) ?>"
                          onclick="return window.confirm(`Êtes vous sur de vouloir supprimer cet article ?!`)">Supprimer</a>
                    </p>
                    <p><a href="index.php?route=editArticle&id=<?= htmlspecialchars($article->getArticles_id()) ?>">
                            Modifier</a></p>
                    <p><a href="index.php?route=editListArticles "> Liste des articles</a></p>
                </div>
            </div>
        </div>
    </article>
    <hr>
<?php $content = ob_get_clean(); ?>
<?php require 'templates/layout_backend.php'; ?>