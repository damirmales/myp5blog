  <!DOCTYPE html>
  <html lang="fr">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="auteur" content="">

    <title>Damir Blog </title>
  <!-- Bootstrap core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet' ?>" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="../../public/css/clean-blog.min.css" rel="stylesheet">

  </head>


   <!-- Blog Author -->
  <header class="masthead" style="background-image: url('../public/img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Ajouter un article</h1>
            <span class="subheading">pour faire vivre le blog</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
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
    </div>
  </div>

  <hr>


  <!-- Bootstrap core JavaScript -->
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="../../public/js/jqBootstrapValidation.js"></script>
 

  <!-- Custom scripts for this template -->
  <script src="../../public/js/clean-blog.min.js"></script>

</body>

</html>
