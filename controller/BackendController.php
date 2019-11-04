<?php
namespace Controller;
use Model\backend\AdminUsers;

class BackendController
{
	/******************* admin management **********************/
	//
	public function checkAdmin()
	{		        
		$userData = new AdminUsers();
		$checkUser = $userData->checkUserData();
var_dump($_POST['login']);
		if ($checkUser['login'] == $_POST['login'])
		{
			
			require 'vue/backend/adminPage.php';

		}
		else
		{
			echo "no admin in database";
		}

		
	}

	public function logAdmin()
	{		        
		require 'vue/backend/login.php';

	}


	public function register()
	{		        
		require 'vue/backend/register.php';

	}

}


