<?php
namespace Controller;
use Model\Articles;
use Model\Comments;
use Model\Emails;
use Model\Users;



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

		$comments=$this->getComments($id); // insérer les commentaires avec l'article
		
		require 'vue/article.php';

	}

	/******************* Front comments management **********************/

	public function getComments($id)
	{	

		$comments = new Comments();
		$comments = $comments->getCommentsFromDb($id);	
		return 	$comments ;

	}

	public function publishComments($id, $nom,$email, $comment)
	{		        
		
		//instancier la classe qui recupère les données des utilisateurs enregistrés
		$user= new Users();
		$checkUser = $user->checkUserRecord($id, $nom,$email);

		//verifier si l'utilisateur ayant soumit le le commentaire est enregistré
		if (($checkUser['nom'] == $nom) && ($checkUser['email'] == $email))
		{
			//Ajouter le commentaire si le visiteur est enregistré
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
				exit;
			}

		}
		else
		{
			header('Location: vue/home.php');
			exit();
		}

	}

	/******************* Front articles categories management **********************/

	public function getCategoryArticles($rubriq)
	{		        
		// récupérer les articles selon la rubrique désirée
		$rubArticles = new Articles();
		$rubriques = $rubArticles->showArticlesByCategory($rubriq);		

		// Associer la vue correspondante à la rubrique sélectionnée
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
			exit;

		}		
		
	}

	/******************* Form contact management **********************/
	
	public function addContact($post)
	{		        

		/******** Contact form check ****************/
		
		$contactMessage="";
		echo "$contactMessage " .$contactMessage;


		if (empty($post['prenom']))
		{
			$_GLOBALS["contactMessage"] = "rien ds le prenom"; // Store error message to be abvailable into home.php
			

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
			// Call class Emails to send contact form data
			$sendEmail = new Emails();
			$email = $sendEmail->sendEmail();	
			echo '$email '.$email;

		}

	}
	//********** acces admin login page *************

	public function logAdmin()
	{		        
		require 'vue/login.php';

	}
	//********** acces admin login page *************

	public function register()
	{		        
		require 'vue/register.php';

	}


}	