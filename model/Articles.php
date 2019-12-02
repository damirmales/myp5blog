<?php
namespace Model;

use Model\PdoConstruct;
/****** **************************************************************************
		Cette classe gère la collecte des données pour afficher la liste des articles 
  		 et chaque article en particulier 
*************************************************************************************/


class Articles extends PdoConstruct
{

//----- Retourne la liste des articles pour affichage ------------
	public function getListArticles()
	{
				
		$listArticles = $this->connection->prepare('
			SELECT articles_id, titre, chapo, auteur,date_creation, date_mise_a_jour 
			FROM articles
			ORDER BY articles_id DESC');
		
		$listArticles->execute();
		$articles = $listArticles->fetchAll();
		return $articles;
	}


//----- Retourne un article particulier pour affichage ------------
	public function singleArticle($idArticle)
	{
	
		$requete = $this->connection->prepare('
			SELECT articles_id, titre, chapo, auteur, contenu,date_creation, date_mise_a_jour
			FROM articles
			WHERE  articles_id = :id
			ORDER BY articles_id DESC'
		);
		$requete->execute( [ ':id' => $idArticle ] );
		$article = $requete->fetch();

		return $article;
	}


	/*-------- Retourne la liste des articles selon la rubrique -------
	 ------------------ pour affichage -----------------------------------*/

	public function showArticlesByCategory($rubrique)
	{

		//$connection = $this->getConnectDB();
		$listArticles = $this->connection->prepare('
			SELECT articles_id, titre, chapo, auteur,contenu, rubrique, date_creation, date_mise_a_jour 
			FROM articles
			WHERE rubrique = "'.$rubrique.'" 
			ORDER BY date_creation DESC');

		$listArticles->execute();
		
		$articles = $listArticles->fetchAll();

		return $articles;
	}

}
