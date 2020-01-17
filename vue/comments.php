<?php use Services\Session;

ob_start();
$session = new Session();
?>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php if (($session->get('user', 'role')) != null) :
                echo $formComment;
            else :
                ?>
                <p> Pour commenter un article vous devez vous enregistrer et/ou vous connecter</p>
                <p>➢<a href="index.php?route=register" class""> s'enregistrer</a></p>
                <p>➢<a href="index.php?route=connexion" class""> se connecter</a></p>
            <?php endif; ?>
            <p>Les commentaires publiés : </p>
            <?php
            foreach ($comments as $comment) {
                ?>
                <!-- Comment Content -->
                <article>
                    <p><strong>Rédigé par <?php echo htmlspecialchars($comment['pseudo']) ?></strong></p>
                    <p>le <?php echo htmlspecialchars($comment['date_ajout']) ?></p>
                    <p><strong>Commentaire</strong></p>
                    <p><?php echo nl2br(htmlspecialchars($comment['contenu'])) ?></p>
                </article>
            <?php } ?>
            <hr>
            <?php $allComments = ob_get_clean(); ?>
        </div>
    </div>
</div>

<?php require 'vue/article.php'; ?>
