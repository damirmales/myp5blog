<?php ob_start();
$titre = "Liste des commentaires";

foreach ($commentEdited as $comment) : //echo '<pre> list_ '; var_dump($comment->getCommentaire_id());
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-preview">

                    <h2 class="post-title">Nom</h2>
                    <p>
                        <?php echo htmlspecialchars($comment->getPseudo()); ?>
                    </p>


                    <h3 class="post-title"> Commentaire </h3>
                    <p> <?= htmlspecialchars($comment->getContenu()); ?></p>


                    <h4 class="post-meta"> Commentaire Publié :
                        <?php
                        $codeValidation = htmlspecialchars($comment->getValidation());
                        if ($codeValidation == 1)
                        {
                        ?>
                            <span> oui  </span>

                        <?php
                        }
                        else
                        {
                        ?>
                            <span> non  </span>      <a href="index.php?route=validateComment&id=<?= $comment->getCommentaire_id(); ?>">-->Autoriser la publication</a>
                        <?php

                      
                        }

                        ?>



                    </h4>

                    <br><br>

                    <h4 class="post-meta">Ajouté le : <?php echo htmlspecialchars($comment->getDate_ajout()); ?></h4>


                </div>

                <p>Lié à l'article : </p>

                <a href="index.php?route=deleteComment&id=<?= $comment->getCommentaire_id(); ?>"
                   onclick="return window.confirm(`Êtes vous sur de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
                <hr>
            </div>
        </div>
    </div>

<?php endforeach ?>

<?php $content = ob_get_clean();
require 'templates/layout_backend.php';

