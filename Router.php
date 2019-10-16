<?php
use Controller\FrontendController;



   class Router
	{
		
	    
	    public function run()
	    {
	        try{
	            if(isset($_GET['route']))
	            {
	                if($_GET['route'] === 'liste'){
	                    //$idArt = $_GET['idArt'];
	                    $frontController = new FrontendController;
	                    $frontController->pullListeArticles();
	                    //require 'vue/articles.php';

	                }
	                elseif($_GET['route'] === 'article'){

	                  //  $idArt = $_GET['id'];
	                	$frontController = new FrontendController;
	                    $frontController->singleArticle($_GET['id']);
	                   //require "vue/article.php";
	                	//$frontend->readArticle();


	                }
	                else
		            {
		                    echo 'page inconnue'." ".var_dump( $idArt);
		            }
	            }
	            else
	            {
	            	$frontController = new FrontendController;
	                $frontController->home();
	            }
	        }
	        catch (Exception $e)
	        {
	            echo 'Erreur';
	        }
	    }
	}
	

?>