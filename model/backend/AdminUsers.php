<?php

namespace Model\backend;

use Model\PdoConstruct;
/****** **************************************************************************
		Cette classe gère la vérification des paramètres d'identification 
		pour l'accès à la partie administration
		*************************************************************************************/

		class AdminUsers extends PdoConstruct
		{
	//----- Retourne la liste des articles pour affichage ------------
			public function checkUserData()
			{
				
				$userData = $this->connection->prepare('
					SELECT login, password
					FROM Users
					WHERE role = "administrateur"
					');

				$userData->execute();
				$user = $userData->fetch();

				return $user;

			}


		}	
