<?php
namespace Controller;
use Model\backend\AdminUsers;

class BackendController
{
	/******************* admin management **********************/
	public function admin()
	{		        
		$userData = new AdminUsers();
		$checkUser = $userData->checkUserData();

		if (isset($checkUser))
		{
			var_dump($checkUser);
			require 'vue/backend/login.php';

		}
		else
		{
			echo "no user in database";
		}

		
	}


}


