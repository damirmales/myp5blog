<?php
namespace Model;
use Model\PdoConstruct;
/*********************************************/
/************ Manage comments ***************/
/*********************************************/

class Contacts extends PdoConstruct
{
	
	/************ Add comments to database ***************/

	public function addContactsToDb($prenom,$nom,$email,$message)
	{

		
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

