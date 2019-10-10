
<?php 

include('header.inc.php'); 

 require_once('../model/Database.php');

 require_once('../Articles.php');

// utilisation d'un objet Articles pour l'affichage de la liste des articles
$newArticles = new Articles();
$articles  = $newArticles->getListArticles();



?>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('../public/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Les articles </h1>
            <span class="subheading">Blog de damir</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  

<?php 
//ob_start();
require('../templates/layout_articles.php');
//$pageContent = ob_get_clean();

?>        
        
		<!-- ajouter un nouvel article -->
		<p><a href="ajout_article.php">Ajouter un article</a>
        <hr>
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Anciens articles &rarr;</a>
        </div>
      </div>
    </div>
  </div>

  <hr>

<?php 
include('footer.inc.php'); 

?>


  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="../public/js/clean-blog.min.js"></script>

</body>

</html>
