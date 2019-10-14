<?php
namespace model;

	class Comments extends Database
	{
	    public function getCommentsFromArticle($articleId)
	    {

	    	$connection = self::getConnectDB();

	        $requete = $connection->prepare('
	        	SELECT commentaire_id, contenu, date_ajout 
	        	FROM commentaires
	        	WHERE  Articles_articles_id= :id
	        	ORDER BY date_ajout DESC'
	        );

	        $requete->execute( [ ':id' => $articleId ] );
	        $comment = $requete->fetchAll();
	        return $comment;
	    }
	}

?>

