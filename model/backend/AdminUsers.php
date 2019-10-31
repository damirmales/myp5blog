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
					SELECT id, login, password
					FROM Users');

				$userData->execute();
				$user = $userData->fetch();
				return $user;

			}
		}	
