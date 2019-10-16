<?php
namespace Controller;
use Model\Articles;


class FrontendController{



		public function home()
		{		        
		        require 'vue/home.php';
		}

	

		public function pullListeArticles()
		{		        
				$listeArticles = new Articles();
				$articles = $listeArticles->getListArticles();
		        require 'vue/articles.php';
		}


		public function singleArticle($id)
		{		        
		 	$article = new Articles();
         	$article = $article->singleArticle($id);
       

		        require 'vue/article.php';
		        
		}

   

}