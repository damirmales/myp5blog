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
//----- Check if user's login is in the DB ------------

			public function checkUserData($loginUser)
			{
				
				$userData = $this->connection->prepare('
					SELECT *
					FROM users
					WHERE login = :loginUser
					');

				$userData->execute( [ ':loginUser' => $loginUser ] );
				
				$user = $userData->fetch();

				return $user;

			}

						/************ Add user to database ***************/

			public function addUserToDb($post,$token)
			{

				$requete = $this->connection->prepare('
					INSERT INTO users (id,nom,prenom,email,role,statut,token,login,password)
					VALUES (:id,:nom,:prenom,:email,:role,:statut,:token,:login,:password)
					');
				$requete->bindValue(':id', NULL, \PDO::PARAM_INT);
				$requete->bindValue(':nom', $post['nom'], \PDO::PARAM_STR);
				$requete->bindValue(':prenom', $post['prenom'], \PDO::PARAM_STR);
				$requete->bindValue(':email', $post['email'], \PDO::PARAM_STR);
				$requete->bindValue(':role', 'member', \PDO::PARAM_STR);
				$requete->bindValue(':statut', 0, \PDO::PARAM_INT);
				$requete->bindValue(':token', $token, \PDO::PARAM_STR);
				$requete->bindValue(':login', $post['login'], \PDO::PARAM_STR);
				$requete->bindValue(':password', $this->hashPassword($post['password']), \PDO::PARAM_STR);

				$affectedLines = $requete->execute();

				return $affectedLines;

			}

						//** encrypt password ********
			private function hashPassword($pswd)
			{
				$pwd_hashed = password_hash($pswd, PASSWORD_DEFAULT);
				return $pwd_hashed;

			}

 }
