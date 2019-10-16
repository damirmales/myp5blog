<?php
namespace Model;
//require_once('Database.php');
use Model\Database;
/****** **************************************************************************
		Cette classe gère la collecte des données pour afficher la liste des articles 
  		 et chaque article en particulier 
*************************************************************************************/

class Articles extends Database
{

//----- Retourne la liste des articles pour affichage ------------
	public function getListArticles()
	{


		//$connection = self::getConnectDB();
		$connection = $this->getConnectDB();
		$listArticles = $connection->query('
			SELECT articles_id, titre, chapo, auteur, date_mise_a_jour 
			FROM articles
			ORDER BY articles_id DESC');
		
		$articles = $listArticles->fetchAll();
		return $articles;
	}


//----- Retourne un article particulier pour affichage ------------
	public function singleArticle($idArticle)
	{


		$connection = $this->getConnectDB();
		$requete = $connection->prepare('
			SELECT articles_id, titre, chapo, auteur, contenu, date_mise_a_jour
			FROM articles
			WHERE  articles_id = :id
			ORDER BY articles_id DESC'
		);
		$requete->execute( [ ':id' => $idArticle ] );
		$article = $requete->fetch();

		return $article;
	}

}
