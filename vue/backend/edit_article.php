<?php ob_start();
$titre = "Modifier un article";
$messOk="";
?>
<div class="col-lg-8 col-md-10 mx-auto">
    <p>Vous pouvez modifier cet article</p>

    <?php
    if(isset($addArticleErrorMessage) && empty($addArticleErrorMessage)){
        flashMessage2($messOk);
    }

    ?>

        <form action="index.php?route=updateArticle" method="post" name="sentMessage" id="addArticleForm" novalidate>
            <input type="hidden" name="articles_id" value="<?= $article->getArticles_id();?>">
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>titre</label>
                    <input type="text" class="form-control" placeholder="Titre" name="titre" id="titre"
                           value="<?= htmlspecialchars($article->getTitre()); ?>" required
                           data-validation-required-message="Entrez le titre.">
                    <p class="help-block text-danger"></p>
                </div>
            </div>

            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Châpo</label>
                    <input type="text" class="form-control" placeholder="Châpo" name="chapo" id="chapo"
                           value="<?= htmlspecialchars($article->getChapo()); ?>"" required
                           data-validation-required-message="Entrez le châpo.">
                    <p class="help-block text-danger"></p>
                </div>
            </div>

            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Auteur</label>
                    <input type="text" class="form-control" placeholder="Auteur" name="auteur" id="auteur"
                           value="<?= htmlspecialchars($article->getAuteur()); ?>"" required
                           data-validation-required-message="Entrez votre nom.">
                    <p class="help-block text-danger"></p>
                </div>
            </div>

            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Contenu</label>
                    <textarea rows="5" class="form-control" placeholder="Contenu" name="contenu" id="contenu"
                              required
                              data-validation-required-message="Entrez le texte."><?= htmlspecialchars($article->getContenu()); ?></textarea>
                    <p class="help-block text-danger"></p>
                </div>
            </div>

            <br>
            <div id="success"></div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="btn_creer_article" id="sendMessageButton">Envoyez
                </button>
            </div>
        </form>
    </div>
    <hr>

    <?php $content = ob_get_clean(); ?>

    <?php require 'templates/layout_backend.php'; ?>
  