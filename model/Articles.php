<?php
namespace Model;

use Model\PdoConstruct;
/****** **************************************************************************
		Cette classe gère la collecte des données pour afficher la liste des articles 
  		 et chaque article en particulier 
*************************************************************************************/


class Articles extends PdoConstruct
{
  
    //private $id;
    private $titre;
    private $chapo;
    private $auteur;
    private $contenu;
    private $rubrique;

  /************ Add articles to database ***************/

    public function addArticleToDb($post)
    {
        

        
        $requete = $this->connection->prepare('
            INSERT INTO articles (articles_id,titre,chapo,auteur,contenu,rubrique,date_creation,date_mise_a_jour)
            VALUES (:id,:titre,:chapo,:auteur,:contenu,:rubrique,NOW(),NOW())
            ');
        $requete->bindValue(':id', NULL, \PDO::PARAM_INT);
        $requete->bindValue(':titre', $titre, \PDO::PARAM_STR);
        $requete->bindValue(':chapo', $chapo, \PDO::PARAM_STR);
        $requete->bindValue(':auteur', $auteur, \PDO::PARAM_STR);
        $requete->bindValue(':contenu', $contenu, \PDO::PARAM_STR);
        $requete->bindValue(':rubrique', $rubrique, \PDO::PARAM_STR);
        $requete->bindValue(':date_creation', $date_creation, \PDO::PARAM_INT);
        $requete->bindValue(':date_mise_a_jour', $date_mise_a_jour, \PDO::PARAM_INT);

        $affectedLines = $requete->execute();

        return $affectedLines;

    }


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
	public function getSingleArticle($idArticle)
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

	public function getArticlesByCategory($rubrique)
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
