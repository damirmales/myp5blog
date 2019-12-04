<?php ob_start();
$titre = "Liste des commentaires";

foreach ($commentEdited as $comment) : //echo '<pre> list_ '; var_dump($comment->getCommentaire_id());?>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-preview">

                    <h2 class="post-title">Nom</h2>
                    <p>
                            <?php echo htmlspecialchars($comment->getPseudo()); ?>
                    </p>


                    <h3 class="post-subtitle"> Commentaire  </h3>
                       <p> <?php echo  htmlspecialchars($comment->getContenu()); ?></p>



                    <p class="post-meta">Ajouté le :
                        <?php echo  htmlspecialchars($comment->getDate_ajout()); ?>
                    </p>


                </div>

                <p>Lié à l'article : <?=  "rr"?> </p><br>
                <a href="index.php?route=deleteComment&id=<?= $comment->getCommentaire_id(); ?>" onclick="return window.confirm(`Êtes vous sur de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
                <hr>
            </div>
        </div>
    </div>

<?php endforeach ?>

<?php $content = ob_get_clean();
require'templates/layout_backend.php';

