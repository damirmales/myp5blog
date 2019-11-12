<?php
namespace Controller;
session_start();
use Model\Articles;
use Model\Comments;
use Model\Emails;
use Model\Users;
use Model\backend\AdminUsers;


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
				exit();

			}		
			
		}

		/******************* Form contact management **********************/
		
		public function addContact($post)
		{	

			/******** Contact form check ****************/
			
			$contactErrorMessage=[];// Store error message to be available into home.php
			$messageSend = "";

			if (!empty($_POST))
			{ 


				if($_POST['formContact'] == 'sent' )
				{


					if (empty($post['prenom']))
					{

						$contactErrorMessage['prenom'] ="Prénom non renseigné";


					}
					if(empty($post['nom']))
					{
						$contactErrorMessage['nom'] ="Nom non renseigné";


					}
					if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
					{
						$contactErrorMessage['email']  ="L'email doit être selon format :bibi@fricotin.fr";


					}
					if(empty($post['message']))
					{
						$contactErrorMessage['message'] ="Le message manque";


					}

	/*echo "<pre>";
		print_r($_POST)	 ; 
		print_r($contactErrorMessage);
	*/		

//var_dump($contactErrorMessage);

					if (empty($contactErrorMessage))
					{
	
						
					/***** Call class Emails to send contact form data*/
					$sendEmail = new Emails();
					$email = $sendEmail->sendEmail();	


					$this->messageEmailContactOK($email);

						/* $sendEmail = new Emails();
						$email = $sendEmail->swiftMailer();	*/
					}
					else
					{
						$_SESSION["contactFormKO"] = "email non envoyé";
						//$noMessageSend = "addContact email non envoyé";
						$this->saveFormData();
					}
				}	
			}

			require 'vue/home.php';

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


		/**************** a mettre ds un gestionnaire d'outils ************/
		public function messageEmailContactOK($emel)
		{

			if ($emel == true)
			{ 
				$_SESSION["contactFormOK"] = "function messageEmailContactOK email envoyé";
				//$messageSend = "email envoyé";

				header('Location: index.php');
				exit();
			}
			else
			{
				$_SESSION["contactFormKO"] = "email non envoyé";
					//$noMessageSend = "messageEmailContactOK email non envoyé";
			}
		}


//*** save all input value entered by user ***
		public function saveFormData()
		{ 
			foreach ($_POST as $key => $value)
			{
				$_SESSION['input'] [$key] = $value;
			
			}
		}


		/******************* Check user presence in database **********************/
				//
		public function checkUser()
		{		        
			$userData = new AdminUsers();
			$checkUser = $userData->checkUserData($_POST['login']);

					//---- check if user is registered ---------
			if (($checkUser['login'] === $_POST['login']) && password_verify($_POST['password'], $checkUser['password'] ))
			{
						//------ check if user is admin --------
				if ($this->userRole($checkUser))
				{
					require 'vue/backend/adminPage.php';
				}
				else
				{
					$_GLOBALS["contactMessage"] = "Vous êtes membre";
					require 'vue/login.php';
				}


			}
			elseif(empty($_POST['login']))
			{
				$_GLOBALS["contactMessage"] = "Pas de login renseigné";
				require 'vue/login.php';

			}
			elseif(empty($_POST['password']))
			{
				$_GLOBALS["contactMessage"] = "Pas de password renseigné";
				require 'vue/login.php';

			}
			else
			{
				echo "Vous n'êtes pas enregistré(e)";
				require 'vue/home.php';
						//header('Location: vue/login.php');
						//exit;

			}

		}

		/******************* Add user from register.php to database  **********************/

		public function addUser()
		{	
			$post = $_POST;
			/******** Contact form check ****************/

		$contactMessage=""; // on initialise ne variable pour afficher les erreurs dans les champs du formulaire
		echo "$contactMessage " .$contactMessage;



		
		$_SESSION['nom'] = "Entrez le nom" ;	


		if (empty($post['nom']))
		{
						$_GLOBALS["contactMessage"] = "rien ds le nom"; // Store error message to be abvailable into register.php	
						require 'vue/register.php';

					}
					elseif(empty($post['prenom']))
					{

						$_GLOBALS["contactMessage"] = "rien ds le prenom";
						require 'vue/register.php';
						
					}
					elseif(empty($post['email']))
					{

						$_GLOBALS["contactMessage"] = "rien ds le email";
						require 'vue/register.php';

					}
					//check given email address 
					elseif(!empty($post['email']) && !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) 
					{					
						$_SESSION['nom'] = $post['nom'] ;	
						echo($post['email']."  is not a valid email address ".$_SESSION['nom']);

						require 'vue/register.php';						
						
					}
					elseif(empty($post['login']))
					{
						$_GLOBALS["contactMessage"] = "rien ds le login";
						require 'vue/register.php';
					}
					elseif(empty($post['password']))
					{

						$_GLOBALS["contactMessage"] = "rien ds le password";
						require 'vue/register.php';
					}
					elseif(empty($post['password2']))
					{

						$_GLOBALS["contactMessage"] = "rien ds le password2";
						require 'vue/register.php';
					}
					elseif(($post['password2']) !== ($post['password'])  )
					{

						$_GLOBALS["contactMessage"] = "les champs des mots de passe doivent être identique";
						require 'vue/register.php';
					}
					else 
					{

						echo "formulaire envoyé";
						//instancier la classe qui envoie les données des utilisateurs vers la bdd
						$user= new AdminUsers();
						$checkUser = $user->addUserToDb($post);

						echo $checkUser;

					}

				}

					//** check user's role ********
				private function userRole($role)
				{
					var_dump($role['statut']);
					if (($role['role'] === 'admin') &&  ($role['statut'] == 1))
					{
						echo '$role est admin';
						return true;
					}
					elseif(($role['role'] === 'member') &&  ($role['statut'] == 1))
					{
						echo '$role est member';
						return false;
					}
					else
					{
						echo '$role n\'est ni member ni admin';
						return false;
					}
				}



			}	