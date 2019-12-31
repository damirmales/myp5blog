<?php

namespace Model;

use Model\PdoConstruct;
use Model\Articles;

/******
 *
 * **************************************************************************
 * Cette classe gère la collecte des données pour afficher la liste des articles
 * et chaque article en particulier
 *************************************************************************************/
class ArticleDao extends PdoConstruct
{
    /************
     *
     * Add articles to database
     ***************/
    public function setArticleToDb($article)
    {
        $requete = $this->connection->prepare(
            '
            INSERT INTO articles (articles_id,titre,chapo,auteur,contenu,rubrique,date_creation,date_mise_a_jour)
            VALUES (:id,:titre,:chapo,:auteur,:contenu,:rubrique,NOW(),NOW())
            '
        );
        $requete->bindValue(':id', null, \PDO::PARAM_INT);
        $requete->bindValue(':titre', $article->getTitre(), \PDO::PARAM_STR);
        $requete->bindValue(':chapo', $article->getChapo(), \PDO::PARAM_STR);
        $requete->bindValue(':auteur', $article->getAuteur(), \PDO::PARAM_STR);
        $requete->bindValue(':contenu', $article->getContenu(), \PDO::PARAM_STR);
        $requete->bindValue(':rubrique', $article->getRubrique(), \PDO::PARAM_STR);
        //$requete->bindValue(':date_creation', $this->getDateCreation(), \PDO::PARAM_INT);
        //$requete->bindValue(':date_mise_a_jour', $this->getDateMiseAJour(), \PDO::PARAM_INT);
        $affectedLines = $requete->execute();

        $lastId = $this->connection->lastInsertId();
        $requete->closeCursor();
        return $lastId; //$affectedLines;
    }

    public function updateArticleToDb($article)
    {
        $requete = $this->connection->prepare(
            '
            UPDATE articles
            SET titre = :titre, chapo = :chapo, auteur = :auteur, contenu = :contenu, date_mise_a_jour = NOW()
            WHERE  articles_id = :id
            '
        );
        $requete->bindValue(':id', $article->getArticles_id(), \PDO::PARAM_INT);
        $requete->bindValue(':titre', $article->getTitre(), \PDO::PARAM_STR);
        $requete->bindValue(':chapo', $article->getChapo(), \PDO::PARAM_STR);
        $requete->bindValue(':auteur', $article->getAuteur(), \PDO::PARAM_STR);
        $requete->bindValue(':contenu', $article->getContenu(), \PDO::PARAM_STR);

        $affectedLines = $requete->execute();
        return $affectedLines;
    }

    public function getListArticles()
    {
        $listArticles = $this->connection->prepare(
            '
            SELECT *
            FROM articles
            ORDER BY articles_id DESC'
        );
        $listArticles->execute();
        $articles = [];
        foreach ($listArticles as $article) {
            $articles[] = new Articles($article);
        }
        $listArticles->closeCursor();
        return $articles;
    }

    //----- Retourne la liste des articles pour affichage ------------

    public function getSingleArticle($idArticle)
    {
        $requete = $this->connection->prepare(
            '
            SELECT *
            FROM articles
            WHERE  articles_id = :id
            ORDER BY articles_id DESC'
        );
        $requete->execute([':id' => $idArticle]);
        $article = $requete->fetch(\PDO::FETCH_ASSOC); //si pas FETCH_ASSOC alors on recupere des numéros de colonne
        $requete->closeCursor();
        $oneArticle = new Articles($article);
        return $oneArticle;
    }

    //----- Retourne un article particulier pour affichage ------------

    public function getArticlesByCategory($rubrique)
    {
        //$connection = $this->getConnectDB();
        $listArticles = $this->connection->prepare(
            '
            SELECT articles_id, titre, chapo, auteur,contenu, rubrique, date_creation, date_mise_a_jour 
            FROM articles
            WHERE rubrique = "' . $rubrique . '" 
            ORDER BY date_creation DESC'
        );
        $listArticles->execute();
        $articles = $listArticles->fetchAll();
        $listArticles->closeCursor();
        return $articles;
    }

    /*-------- Retourne la liste des articles selon la rubrique -------
     ------------------ pour affichage -----------------------------------*/

    public function deleteArticle($idArticle)
    {
        try {
            $commentaire = $this->connection->prepare(
                '
                DELETE 
                FROM commentaires
                WHERE Articles_articles_id = :id'
            );

            $commentaire->execute([':id' => $idArticle]);
        } catch (PDOException $e) {
            echo $commentaire . "<br>" . $e->getMessage();
        }
        $article = $this->connection->prepare(
            '
            DELETE 
            FROM articles
            WHERE articles_id = :id'
        );
        $article->execute([':id' => $idArticle]);
        $article->closeCursor();
        return $article;
    }
    //---------- efface l'article en fonction du numéro d'id fournit ----------

    private function buildArticle($field) // create an object Articles to allow acces to its properties    {
    {
        $article = new Articles($field);
        return $article;
    }
}
