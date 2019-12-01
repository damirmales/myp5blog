<?php ob_start(); ?>

<div class="col-lg-8 col-md-10 mx-auto">
    <p>Modifier un article</p>

    <?php
    //============== mettre dans une classe Messages / warning ============
    if (!empty($addArticleErrorMessage))
    {
    ?>
<br/>
    <div class="container alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        ☝ <strong>Attention! </strong><br>
        <?php
        foreach ($addArticleErrorMessage as $err) {

            echo $err . '<br/>';
        }
        echo '</div>';
        }
        ?>

        <form action="index.php?route=modifyArticle" method="post" name="sentMessage" id="addArticleForm" novalidate>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>titre</label>
                    <input type="text" class="form-control" placeholder="Titre" name="titre" id="titre"
                           value="<?= getFormData('newArticle', 'titre') ?>" required
                           data-validation-required-message="Entrez le titre.">
                    <p class="help-block text-danger"></p>
                </div>
            </div>

            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Châpo</label>
                    <input type="text" class="form-control" placeholder="Châpo" name="chapo" id="chapo"
                           value="<?= getFormData('newArticle', 'chapo') ?>" required
                           data-validation-required-message="Entrez le châpo.">
                    <p class="help-block text-danger"></p>
                </div>
            </div>

            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Auteur</label>
                    <input type="text" class="form-control" placeholder="Auteur" name="auteur" id="auteur"
                           value="<?= getFormData('newArticle', 'auteur') ?>" required
                           data-validation-required-message="Entrez votre nom.">
                    <p class="help-block text-danger"></p>
                </div>
            </div>

            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Contenu</label>
                    <textarea rows="5" class="form-control" placeholder="Contenu" name="contenu" id="contenu"
                              value="<?= getFormData('newArticle', 'contenu') ?>" required
                              data-validation-required-message="Entrez le texte."></textarea>
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
  