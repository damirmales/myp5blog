<?php
namespace Model\backend;
use Model\PdoConstruct;

class Article extends PdoConstruct
{

// add attributs
    // hydrate

    /************ Add articles to database ***************/

    public function addArticleToDb()
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

    //----- Show requested article ------------
    public function showArticle($idArticle)
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

    //-----  Get whole articles ------------

    public function showListArticles()
    {
                
        $listArticles = $this->connection->prepare('
            SELECT articles_id, titre, chapo, auteur,date_creation, date_mise_a_jour 
            FROM articles
            ORDER BY articles_id DESC');
        
        $listArticles->execute();
        $articles = $listArticles->fetchAll();
        return $articles;
    }

}