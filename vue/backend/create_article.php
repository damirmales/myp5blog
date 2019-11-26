 <?php ob_start(); ?>





      <div class="col-lg-8 col-md-10 mx-auto">
        <p>Un nouveau sujet</p>

        <!-- -->
		
        <form action="admin.php?route=addArticle" method="post" name="sentMessage" id="addArticleForm" novalidate>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>titre</label>
              <input type="text" class="form-control" placeholder="Titre" name="titre" id="titre" required data-validation-required-message="Entrez le titre.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
		  
		  <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Châpo</label>
              <input type="text" class="form-control" placeholder="Châpo" name="chapo" id="chapo" required data-validation-required-message="Entrez le châpo.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
		  
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Auteur</label>
              <input type="text" class="form-control" placeholder="Auteur" name="auteur" id="auteur" required data-validation-required-message="Entrez votre nom.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
		  <br/>
		    <label class="mr-sm-2" for="inlineFormCustomSelect">Rubrique</label>
		  <select name="rubrique" class="custom-select custom-select-lg mb-3">
			<option selected>Choisir la rubrique...</option>
			<option value="livres">Livres</option>
			<option value="fromages">Fromages</option>
			<option value="autres">Autres</option>
			<p class="help-block text-danger"></p>
		 </select>
		  
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Contenu</label>
              <textarea rows="5" class="form-control" placeholder="Contenu" name="contenu" id="contenu" required data-validation-required-message="Entrez le texte."></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
		  
          <br>
          <div id="success"></div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Envoyez</button>
          </div>
        </form>
      </div>


  <hr>

  <?php $content = ob_get_clean();?>


<?php require'templates/layout_backend.php'; ?>
  