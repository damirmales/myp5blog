<?php
namespace Controller;

use Model\PdoConstruct;
use Model\Articles;
use Model\Comments;
use Model\Users;
use Services\Emails;
use Services\ValidateForms;

require_once ('services/Emails.php');
require_once ('services/ValidateForms.php');
require_once ('functions/functions.php');

class FrontendController extends PdoConstruct
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
		//require 'vue/articles.php';
		require 'vue/articles.php';


	}

	public function getSingleArticle($id)
	{
		$article = new Articles();
		$article = $article->getSingleArticle($id);

			$comments=$this->getComments($id); // insérer les commentaires avec l'article


			require 'vue/commentForm.php';
		}

		/******************* Front comments management **********************/

		public function getComments($id)
		{

			$comments = new Comments();
			$comments = $comments->getCommentsFromDb($id);
			return 	$comments ;

		}

		public function publishComments($articleId, $post)
        {
            $nom = $post['nom'];
            $email = $post['email'];
            $comment = $post['comment'];

            $commentErrorMessage = [];// Store error messages to be available into commentForm.php

            if (isset($post['commentFormBtn']))
            {
                echo "commentFormBtn";
                if (empty($post['nom']))
                {
                    $commentErrorMessage['nom'] = "Nom non renseigné";
                }

                if (empty($post['email']))
                {
                    $commentErrorMessage['email'] = "Email non renseigné";
                }

                if (empty($post['comment']))
                {
                    $commentErrorMessage['comment'] = "Commentaire non renseigné";
                }




                if (empty($commentErrorMessage))
                {
                      echo "pas d'erreur c'est lessieur" ;

                    //instancier la classe qui recupère les données des utilisateurs enregistrés
                    $user = new Users();
                    $checkUser = $user->checkUserRecord($articleId, $nom, $email); // id de l'article

                    //verifier si l'utilisateur ayant soumit le commentaire est enregistré
                    if (($checkUser['nom'] == $nom) && ($checkUser['email'] == $email))
                    {
                        //Ajouter le commentaire et le pseudo si le visiteur est enregistré
                        $newcomment = new Comments();

                        $newcomment->setPseudo($nom);
                        $newcomment->setComment($comment);

                        $affectedLines = $newcomment->addCommentsToDb($articleId); // id de l'article

                        if ($affectedLines === false) {
                            //die('Impossible d\'ajouter le commentaire !');
                            exit('Impossible d\'ajouter le commentaire !');
                        } else {
                            header('Location: index.php?route=article&id=' . $articleId);
                            exit;
                        }

                    }
                    else
                    { echo 'vous n\etes pas membre pour pouvoir commenter';
                        /*header('Location: index.php');
                        exit();*/
                    }

                }

            }
    print_r( $commentErrorMessage['nom'] );
            require 'vue/commentForm.php';
            /*header('Location: index.php?route=article&id=' . $articleId);
            exit;*/
        }
		/******************* Front articles categories management **********************/

		public function getCategoryArticles($rubriq)
		{		        
			// récupérer les articles selon la rubrique désirée
			$rubArticles = new Articles();
			$rubriques = $rubArticles->getArticlesByCategory($rubriq);		

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
				header('Location: index.php');
				exit();

			}		
			
		}
		/******************************************************************/
		/******************* Form contact management **********************/
		
		public function addContact($post)
		{	
			$validContact = new ValidateForms;
			print_r($validContact->verifyEmptiness($post)); 

			/******** Contact form check ****************/
			
			$contactErrorMessage=[];// Store error message to be available into home.php

			if (!empty($_POST))
			{ echo '$_POST vide ';

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

                    if (empty($contactErrorMessage))
                    {

                        /***** Call class Emails to send contact form data*/
                        $sendEmail = new Emails();

                        $sendEmail->setNom($_POST['nom']);
                        $sendEmail->setPrenom($_POST['prenom']);
                        $sendEmail->setEmail($_POST['email']);

                        $email = $sendEmail->sendEmail();


                        $this->messageEmailContactOK($email);

                                    /* $sendEmail = new Emails();
                                    $email = $sendEmail->swiftMailer();	*/
					}
					else
					{
						$_SESSION["contactFormKO"] = "email non envoyé";

						$this->saveFormData('input');
					}
				}	
			}

			require 'vue/home.php';

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
		public function saveFormData($index)
		{ 

			foreach ($_POST as $key => $value)
			{
				$_SESSION[$index] [$key] = $value;

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

		public function logOff()
		{
			unset($_SESSION);
			session_destroy();
			header('Location: index.php');
			exit();
		}

		/**************************************************************************/
		/******************* Before login check user presence in database *********/

				//---- from login.php ---------

		public function checkUser() 
		{		        
			$connexionErrorMessage = [];// Store error message to be available into login.php

			
			if(empty($_POST['login']))
			{
				//$_GLOBALS["contactMessage"] = "Pas de login renseigné";		
				$connexionErrorMessage['login'] = "Pas de login renseigné";

			}

			if(empty($_POST['password']))
			{
				$connexionErrorMessage['password'] = "Pas de password renseigné";			

			}
			//---- if no errors compare form fields data with those into the DB -----
			if (empty($connexionErrorMessage))
			{ 
				
				$userData = new Users();
				$checkUser = $userData->checkUserLogin($_POST['login']);



					//---- check if user is registered ---------
				if (($checkUser['login'] === $_POST['login']) && password_verify($_POST['password'], $checkUser['password'] ))
				{



					if($checkUser['statut'] == 1)
					{
						$_SESSION["user"]['role'] = $checkUser['role'];
						$_SESSION["user"]['nom'] = $checkUser['nom'];
						$_SESSION["user"]['login'] = $checkUser['login'];




						//------ check if user is admin --------
						if ($checkUser['role'] == 'admin')
						{		


						header('Location: index.php?route=admin'); // if user is admin go to admin page
						exit();

						}
						else
						{
							$_SESSION["contactFormOK"] = "Vous êtes member";

							header('Location: index.php');
							exit();
						}
                    }
                    else // statut = 0
                    {
                            echo "Vous n\'êtes pas autorisé à vous connecter";
                            $_SESSION["contactFormOK"] = "Vous êtes pas autorisé à vous connecter";

                            header('Location: index.php');
                            exit();
                    }
			}

			else
			{
				echo "Vous n\'êtes pas enregistré(e)";
				$_SESSION["contactFormOK"] = "Vous êtes pas notre member";

				header('Location: index.php?route=connexion');
				exit();

			}
		}

		require 'vue/login.php';
	}


					//** check user's role ********
	public function userRole($role)
	{
		var_dump($role['statut']);
		if (($role['role'] === 'admin') && ($role['statut'] == 1))
		{
			echo '$role est admin';

			return 'admin';
		}
		elseif(($role['role'] === 'member') && ($role['statut'] == 1))
		{
			echo '$role est member';
			return 'member';
		}
		else
		{
			echo '$role n\'est ni member ni admin';
			return false;
		}
	}
	/**********************************************************************************/	
	/******************* Add user from register.php to database  **********************/

	public function addUser()
	{	
		$post = $_POST;
		/******** Contact form check ****************/

		$registerFormMessage = []; // on initialise un tableau pour afficher les erreurs dans les champs du formulaire

		if (!empty($post))
		{	

			if($post['formRegister'] == 'sent' )
			{
				if (empty($post['nom']))
				{
							$registerFormMessage['nom'] = "rien ds le nom"; // Store error message to be abvailable into register.php	

                }

						if(empty($post['prenom']))
						{

							$registerFormMessage['prenom'] = "rien ds le prenom";
							
						}

						if(empty($post['email']))
						{
							$registerFormMessage['email'] = "rien ds le email";

						}

						//check given email address 
						if(!empty($post['email']) && !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) 
						{					
							$registerFormMessage['email']  ="L'email doit être selon format :bibi@fricotin.fr";
							
						}

						if(empty($post['login']))
						{
							$registerFormMessage['login'] = "rien ds le login";

						}

						if(empty($post['password']))
						{
							$registerFormMessage['password'] = "rien ds le password";

						}

						if(empty($post['password2']))
						{
							$registerFormMessage['password2'] = "rien ds le password2";

						}

						if(($post['password2']) !== ($post['password'])  )
						{
							$registerFormMessage['password2'] = "les champs des mots de passe doivent être identiques";

						}

						//--------------------------------------------------------------
						//---- if no errors in form fields add user's data in DB and ---
						//---- launch email checking with a token ----------------------

						if (empty($registerFormMessage)) 
						{							
							$token = generateToken();
							
							//instancier la classe qui envoie les données des utilisateurs vers la bdd

							$user = new Users();

							$user->setNom($_POST['nom']);
							$user->setPrenom($_POST['prenom']);
							$user->setEmail($_POST['email']);
							$user->setRole('member');
							$user->setStatut(0);
							$user->setToken($token );
							$user->setLogin($_POST['login']);
							$user->setPassword($_POST['password']);

							$userInDb = $user->addUserToDb();
							echo 'userInDb :'.$userInDb;

								//$result =$this->verifyToken();

								//echo 'verifyToken :'.$result;

								/*if ($result)
								{
									//echo $userEmail = getUserEmailandId(); // in functions.php
                                    echo $user->getEmail();
								}
								else
								{
									echo 'token non vérifié';
								}								
                    */

								$userEmail = "damir@romandie.com";

							   $createUrlToken = createUrlWithToken($token);
								
								$anEmail = new Emails();
								$anEmail->tokenEmail($userEmail,$createUrlToken); //in Emails.php class
                            $_SESSION["registerFormOK"] = "email envoyé";
								header('Location: index.php?route=register');
								exit();
							}
							else
							{
								$_SESSION["registerFormOK"] = "email non envoyé";
							//$noMessageSend = "addContact email non envoyé";
								$this->saveFormData('register');
							}
						}
					}
			/*	session_destroy();
				echo "<pre>";
				print_r($post)	 ; 
				print_r($_SESSION);	
				echo "error register";
				print_r($registerFormMessage);
	*/
				require 'vue/register.php';	
				
			}
//*********** check the token from the link validate by the user **************
			public function verifyToken()
			{
				if(isset($_GET['token'])) // if got user's token from email
				{
					$userToken = trim($_GET['token']);//token from email

					$sql = "SELECT nom  FROM users WHERE  token = :token";

					$stmt = $this->connection->prepare($sql);
					
					$stmt->bindParam(':token', $userToken);
					$stmt->execute();

					$result = $stmt->fetch(\PDO::FETCH_ASSOC);

echo "nom user : ".$result['nom'];
                    $_SESSION["userName"] = $result['nom'];
					//return $result;
                    header('Location: index.php');
                    exit();
				}				
			}

		}	