<?php
namespace Controller;
use Model\backend\AdminUsers;

class BackendController
{
	/******************* User presence in database **********************/
	//
	public function checkUser()
	{		        
		$userData = new AdminUsers();
		$checkUser = $userData->checkUserData($_POST['login']);


		if (($checkUser['login'] === $_POST['login']) && password_verify($_POST['password'], $checkUser['password'] ))
		{
			
			require 'vue/backend/adminPage.php';

		}
		else
		{
			
			//header('Location: vue/login.php');
			require 'vue/login.php';
			echo "no user in database";
			exit;
		}
		
	}

	/******************* Add user to database  **********************/
	
	public function addUser()
	{		        
		$post = $_POST;
		/******** Contact form check ****************/
		
		$contactMessage="";
		echo "$contactMessage " .$contactMessage;


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
			// Call class Emails to send contact form data
			echo "formulaire envoyé";
			//instancier la classe qui recupère les données des utilisateurs enregistrés
			$user= new AdminUsers();
			$checkUser = $user->addUserToDb($post);

			echo $checkUser;


		}


	}



}


