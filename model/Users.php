<?php
namespace Model;
use Model\PdoConstruct;

class Users extends PdoConstruct
 {

 	//----- Vérifie l'enregistrement de l'utilisateur ------------
			public function checkUserRecord()
			{
				
				$userRecord = $this->connection->prepare('
					SELECT id,nom,email
					FROM Users
					');

				$userRecord->execute();
				$user = $userRecord->fetch();
				
				return $user;
			}

 }
