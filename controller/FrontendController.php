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
		$comment = new Comments();
		$affectedLines = $comment->addCommentsToDb($id,$comment);		

		    if ($affectedLines === false) {
        die('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?route=article&id=' . $id);
    }
		
	}


}