<?php ob_start();
$titre = "Liste des commentaires";
$row = 0; // to display number for each row of the comment table
?>
    <div class="container table-responsive ">
        <table class="table  table-hover table-striped">
            <thead class="bg_comment_table text-white text-center">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Auteur</th>
                <th scope="col">Contenu</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody class="text-center">
            <?php
            foreach ($commentEdited as $comment) :
                ?>
                <tr>
                    <th scope="row"><?= ++$row ?></th>
                    <td><?php echo htmlspecialchars($comment->getPseudo()); ?></td>
                    <td><?= htmlspecialchars($comment->getContenu()); ?></td>
                    <td><a href="index.php?route=deleteComment&id=<?= addslashes($comment->getCommentaire_id()) ?>"
                           onclick="return window.confirm(`Êtes vous sur de vouloir supprimer ce commentaire ?!`)"> ✄
                            Supprimer</a>
                        <br/>
                        <a href="index.php?route=validateComment&id=<?= htmlspecialchars($comment->getCommentaire_id()) ?>"> ✌ Autoriser
                            la publication</a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php $content = ob_get_clean();
require 'templates/layout_backend.php';

