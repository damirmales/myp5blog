<?php
namespace Controller;
use Model\backend\AdminUsers;

class BackendController
{
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
					else
					{
						echo '$role n\'est pas admin';
						return false;
					}
				}



			}


