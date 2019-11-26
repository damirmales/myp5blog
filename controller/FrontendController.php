<?php
namespace Controller;
use Model\Articles;
use Model\Comments;
use Model\Contacts;



class FrontendController
{

	/******************* home management **********************/
	public function home()
	{		        
		require 'vue/home.php';
	}

	/******************* cv  **********************/
	public function cv()
	{		        
		require 'vue/cv.php';
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


		if ($affectedLines === false)
		{
			//die('Impossible d\'ajouter le commentaire !');
			exit('Impossible d\'ajouter le commentaire !');
		}
		else 
		{
			header('Location: index.php?route=article&id=' . $id);
		}
		
	}

	/******************* Front articles categories management **********************/

	public function getCategoryArticles($rubriq)
	{		        
		$rubArticles = new Articles();
		$rubriques = $rubArticles->showArticlesByCategory($rubriq);		

		
		if ($rubriq == "livres")
		{

			require 'vue/livres.php';
			
		}
		elseif ($rubriq == "fromages")
		{
			require 'vue/fromages.php';
		}
		else
		{
			header('Location: vue/home.php');

		}		
		
	}

	/******************* Form contact management **********************/
	
	public function addContact($post)
	{		        

		/******** Contact form check ****************/
		
		$contactMessage="";
		echo "$contactMessage " .$contactMessage;

		//if ($post['prenom']!= null && $post['nom'] != null && $post['email'] != null && $post['message'] != null)
		if (empty($post['prenom']))
		{
			$_GLOBALS["contactMessage"] = "rien ds le prenom"; // stocke le message pour d'erreur pour le rendre disponible dans home.php
			

			require 'vue/home.php';

		}
		elseif(empty($post['nom']))
		{

			$_GLOBALS["contactMessage"] = "rien ds le nom";
			require 'vue/home.php';
			
		}
		elseif(empty($post['email']))
		{

			$_GLOBALS["contactMessage"] = "rien ds le email";
			require 'vue/home.php';

		}
		elseif(empty($post['message']))
		{

			$_GLOBALS["contactMessage"] = "rien ds le message";
			require 'vue/home.php';
		}
		else 
		{
			
			  // Nettoyage des chaines envoyées
			$post['prenom']  = isset($post['prenom'])  ? trim($post['prenom'])  : '';
			$post['nom']  = isset($post['nom'])  ? trim($post['nom'])  : '';
			$post['message'] = isset($post['message']) ? trim($post['message']) : '';
			$post['email']    = isset($post['email'])    ? intval($post['email'])  : 5;


			$post['prenom'] = htmlspecialchars($post['prenom']) ;
			$post['nom']  = htmlspecialchars($post['nom']) ;
			$post['message'] = htmlspecialchars($post['message']) ;
			$post['email'] = htmlspecialchars($post['email']) ;


			$contact = new Contacts();
			$affectedLines = $contact->addContactsToDb($post['prenom'],$post['nom'],$post['email'],$post['message']);

			
			if ($affectedLines === false)
			{
				//die('Impossible d\'ajouter le contact!');
				exit('Impossible d\'ajouter le contact!');
			}
			else
			{
				require 'vue/home.php';
			}

		}


	}
}	