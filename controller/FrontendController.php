<?php
namespace Controller;
use Model\Articles;
use Model\Comments;


class FrontendController{



	/******************* home management **********************/
	public function home()
	{		        
		require 'vue/home.php';
	}

	/******************* Front articles management **********************/	

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

	/******************* Front comments management **********************/

	public function getComments($id)
	{		        
		$comments = new Comments();
		$comments = $comments->getCommentsFromDb($id);		

		require 'vue/comments.php';
		
	}

	public function publishComments($id, $nom, $comment)
	{		        

		$newcomment = new Comments();
		$affectedLines = $newcomment->addCommentsToDb($id, $nom,$comment);		


		if ($affectedLines === false) {
			die('Impossible d\'ajouter le commentaire !');
		}
		else {
			header('Location: index.php?route=article&id=' . $id);
		}
		
	}

	/******************* Front comments management **********************/

	public function getCategoryArticles($rubriq)
	{		        
		$rubArticles = new Articles();
		$rubriques = $rubArticles->showArticlesByCategory($rubriq);		

		
		if ($rubriq == "livres"){

			require 'vue/livres.php';
			
		}
		elseif ($rubriq == "fromages") {
			require 'vue/fromages.php';
		}
		else{
			header('Location: vue/home.php');

		}		
		
	}

	public function addContact($id)
	{		        
		$article = new Articles();
		$article = $article->singleArticle($id);

		require 'vue/article.php';		

	}


}