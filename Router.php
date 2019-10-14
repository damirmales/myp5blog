<?php



/*
class Router {

    private $url; // Contiendra l'URL sur laquelle on souhaite se rendre
    private $routes = []; // Contiendra la liste des routes

    public function __construct($url){
        $this->url = $url;
    }
*/



   class Router
	{
	    public function run()
	    {
	        try{
	            if(isset($_GET['route']))
	            {
	                if($_GET['route'] === 'liste'){
	                    //$idArt = $_GET['idArt'];
	                    require 'vue/articles.php';
	                }
	                else
	                {
	                    echo 'page inconnue';
	                }
	            }
	            else
	            {
	               require 'home.php';
	            }
	        }
	        catch (Exception $e)
	        {
	            echo 'Erreur';
	        }
	    }
	}
	

?>