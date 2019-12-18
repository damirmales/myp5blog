<?php ob_start();
$titre = "Liste des commentaires";
$row = 0;
?>
    <div class="container table-responsive ">

    <table class="table  table-hover table-striped">
    <thead class="bg-primary text-white text-center">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Auteur</th>
        <th scope="col">Contenu </th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
<?php
foreach ($commentEdited as $comment) :
    ?>

        <tr>
            <th scope="row"><?= ++$row ?></th>
            <td><?php echo htmlspecialchars($comment->getPseudo()); ?></td>
            <td><?= htmlspecialchars($comment->getContenu()); ?></td>
            <td><a href="index.php?route=deleteComment&id=<?= $comment->getCommentaire_id(); ?>"
                    onclick="return window.confirm(`Êtes vous sur de vouloir supprimer ce commentaire ?!`)"> ✄ Supprimer</a>
            <br/>
                <a href="index.php?route=validateComment&id=<?= $comment->getCommentaire_id(); ?>"> ✌ Autoriser la publication</a>
            </td>
        </tr>


<?php endforeach ?>
    </tbody>
    </table>
    </div>
<?php $content = ob_get_clean();
require 'templates/layout_backend.php';

