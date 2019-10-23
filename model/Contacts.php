<?php
namespace Model;
use Model\Database;

/*********************************************/
/************ Manage comments ***************/
/*********************************************/

class Contacts extends Database
{
	
	/************ Add comments to database ***************/

	public function addContactsToDb($prenom,$nom,$email,$message)
	{
		private $connection;

		public function __construct(){

			$this->connection = $this->getConnectDB();
			
		}
		
		$requete = $this->connection->prepare('
			
			INSERT INTO contacts
			VALUES (:id,:prenom,:nom,:emel,:message,NOW())
			');
		$requete->bindValue(':id', NULL, \PDO::PARAM_INT);
		$requete->bindValue(':prenom', $prenom, \PDO::PARAM_STR);
		$requete->bindValue(':nom', $nom, \PDO::PARAM_STR);
		$requete->bindValue(':emel', $email, \PDO::PARAM_STR);
		$requete->bindValue(':message', $message, \PDO::PARAM_STR);
	

		$affectedLines = $requete->execute();

		return $affectedLines;

	}
	
}		

?>

