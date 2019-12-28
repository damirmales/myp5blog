<?php ob_start();?>
<?php
if (!empty($commentErrorMessage)) {
    flashMessage($commentErrorMessage);
}
if (!empty($_SESSION['waitingValidation'])) {
    flashMessage2($_SESSION['waitingValidation']);
    unset($_SESSION['waitingValidation']);
}
?>
<form action="index.php?route=addComment&id=<?= $article->getArticles_id() ?>" method="post" name="commentForm">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Votre commentaire</span>
        </div>
        <textarea class="form-control" aria-label="With textarea" name="comment"></textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-primary" name="commentFormBtn">Envoyer</button>
</form>

<?php $formComment = ob_get_clean(); ?>
<?php require 'vue/comments.php'; ?>
