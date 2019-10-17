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
	        	SELECT commentaire_id, contenu, date_ajout 
	        	FROM commentaires
	        	WHERE  Articles_articles_id = :id
	        	ORDER BY date_ajout DESC'
	        );

	        $requete->execute( [ ':id' => $articleId ] );
	        $comments = $requete->fetchAll();
	        return $comments;
	    }

		/************ Add comments to database ***************/

	     public function addCommentsToDb($articleId,$comment)
	    {

	    	$connection = self::getConnectDB();

	        $requete = $connection->prepare('
	        	INSERT INTO commentaires 
	        	VALUES (null, $comment, now(),$articleId,2)
	        ');

	       $affectedLines = $requete->execute();
var_dump($affectedLines);
    return $affectedLines;
	    }
	}

?>

