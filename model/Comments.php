<?php
namespace Model;
use Model\Database;

/*********************************************/
/************ Manage comments ***************/
/*********************************************/

class Comments extends Database
{
	/************ Fetch comments from database ***************/

	public function getCommentsFromDb($articleId)
	{

		$connection = self::getConnectDB();

		$requete = $connection->prepare('
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


		$connection = self::getConnectDB();
		var_dump('$comment '.$comment);
		$requete = $connection->prepare('
			INSERT INTO commentaires (commentaire_id,pseudo,contenu,date_ajout,validation,date_validation,Articles_articles_id)
			VALUES (:id,:nom,:comment,:dateajout,:valid,:datevalid,:idart)
			');
		$requete->bindValue(':id', NULL, \PDO::PARAM_INT);
$requete->bindValue(':nom', $nom, \PDO::PARAM_STR);
$requete->bindValue(':comment', $comment, \PDO::PARAM_STR);
$requete->bindValue(':dateajout', '2019-10-08', \PDO::PARAM_INT);
$requete->bindValue(':valid', 1, \PDO::PARAM_INT);
$requete->bindValue(':datevalid', '2019-10-08', \PDO::PARAM_INT);
$requete->bindValue(':idart', $articleId, \PDO::PARAM_INT);

		$affectedLines = $requete->execute();

   // return $affectedLines;


	}
	/*
		 public function addCommentsToDb($nom,$comment,$articleId)
	        {
	        $nom = "testnom";
	        $comment = "testcomment";
	         $articleId = "1";

	            $connection = self::getConnectDB();

	            $requete = $connection->prepare('
	                INSERT INTO commentaires 
	                VALUES (NULL, $nom, $comment, now(),1,now(),$articleId)
	            ');

	            $affectedLines = $requete->execute();
			}
			*/
	}		

?>

