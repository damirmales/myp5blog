<?php
namespace Model;
use Model\PdoConstruct;

/*********************************************/
/************ Manage comments ***************/
/*********************************************/

class Comments extends PdoConstruct
{
	/************ Fetch comments from database ***************/


	public function getCommentsFromDb($articleId)
	{

	
		$requete = $this->connection->prepare('
			SELECT commentaire_id, pseudo, contenu, date_ajout 
			FROM commentaires
			WHERE  Articles_articles_id = :id
			ORDER BY date_ajout DESC'
		);

		$requete->execute( [ ':id' => $articleId ] );
		$comments = $requete->fetchAll();
		return $comments;
	}

	/************ Add comments to database ***************/

	public function addCommentsToDb($articleId,$nom,$comment)
	{

	
		$requete = $this->connection->prepare('
			INSERT INTO commentaires (commentaire_id,pseudo,contenu,date_ajout,validation,date_validation,Articles_articles_id)
			VALUES (:id,:nom,:comment,NOW(),:valid,NOW(),:idart)
			');
		$requete->bindValue(':id', NULL, \PDO::PARAM_INT);
		$requete->bindValue(':nom', $nom, \PDO::PARAM_STR);
		$requete->bindValue(':comment', $comment, \PDO::PARAM_STR);
		$requete->bindValue(':valid', 1, \PDO::PARAM_INT);
		$requete->bindValue(':idart', $articleId, \PDO::PARAM_INT);

		$affectedLines = $requete->execute();

		return $affectedLines;

	}
	
}		



