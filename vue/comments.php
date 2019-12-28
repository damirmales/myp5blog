<?php ob_start(); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
    <?php
    if (!isset($_SESSION['user']['role'])) {
        if (($_SESSION['user']['role'] === 'member') || ($_SESSION['user']['role'] === 'admin')) {

            echo $formComment; // affiche le formulaire pour commenter
        } else {
            ?>
            <p> Pour commenter un article vous devez vous enregistrer et/ou vous connecter</p>
            <p>➢<a href="index.php?route=register" class""> s'enregistrer</a></p>
            <p>➢<a href="index.php?route=connexion" class""> se connecter</a></p>
            <?php
        }
    } else {
        $_SESSION['user']['role'] = null;
    }
    ?>
    <p>Les commentaires</p>
    <?php
    foreach ($comments as $comment) {
        ?>
        <!-- Comment Content -->
        <article>
                    <p><strong>Rédigé par <?= htmlspecialchars($comment['pseudo']) ?></strong></p>
                    <p>le <?= $comment['date_ajout'] ?></p>
                    <p><strong>Commentaire</strong></p>
                    <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
        </article>
    <?php } ?>
    <hr>
    <?php $allComments = ob_get_clean(); ?>
</div>
    </div>
</div>

<?php require 'vue/article.php'; ?>
