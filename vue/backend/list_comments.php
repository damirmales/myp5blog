<?php ob_start();
$titre = "Liste des commentaires";

foreach ($commentEdited as $comment) : ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-preview">



                    <h2 class="post-title">
                        <a href="index.php?route=showArticle&id=<?= $comment->getCommentaire_id() ?>">   <?php echo htmlspecialchars($comment->getPseudo()); ?>
                        </a>
                    </h2>

                    <h3 class="post-subtitle">
                        <?php echo  htmlspecialchars($comment->getContenu()); ?>
                    </h3>


                    <p class="post-meta">Ajouté le :
                        <?php echo  htmlspecialchars($comment->getDate_ajout()); ?>
                    </p>


                </div>

                <a href="index.php?route=showArticle&id=<?= $comment->getCommentaire_id() ?>">Voir le commentaire</a><br>
                <a href="index.php?route=deleteArticle&id=<?= $comment->getCommentaire_id() ?>" onclick="return window.confirm(`Êtes vous sur de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
                <hr>
            </div>
        </div>
    </div>

<?php endforeach ?>

<?php $content = ob_get_clean();
require'templates/layout_backend.php';

