<?php
namespace Controller;
use Model\Articles;
use Model\Comments;
use Model\Contacts;

class FrontendController{



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

	/******************* Form contact management **********************/
	//public function addContact($prenom,$nom,$email,$message)
	public function addContact($post)
	{		        

		/** ---- 
 * Contrôle du formulaire
 */
		//if (!empty($post))
		if ($post['prenom']!= null && $post['nom'] != null && $post['email'] != null && $post['message'] != null)
		{
  // Nettoyage des chaines envoyées
			$_POST['prenom']  = isset($_POST['prenom'])  ? trim($_POST['prenom'])  : '';
			$_POST['nom']  = isset($_POST['nom'])  ? trim($_POST['nom'])  : '';
			$_POST['message'] = isset($_POST['message']) ? trim($_POST['message']) : '';
			$_POST['email']    = isset($_POST['email'])    ? intval($_POST['email'])  : 5;


			// Le pseudo est-il rempli ?



			$contact = new Contacts();
			$affectedLines = $contact->addContactsToDb($_POST['prenom'],$_POST['nom'],$_POST['email'],$_POST['message']);

			var_dump("affectedLines : ".$affectedLines);

			if ($affectedLines === false) {
				die('Impossible d\'ajouter le contact!');
			}
			else {
				header('Location: index.php');
			}


		}
		else {
			echo "rien ds le formulaire";
		}


	}
}	