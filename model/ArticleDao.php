<?php

namespace Model;

/**
 * Cette classe gère la collecte des données pour afficher la liste des articles
 * et chaque article en particulier
 */
class ArticleDao extends PdoConstruct
{
    /**
     * Add articles to database
     */
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

        $requete->execute();

        $lastId = $this->connection->lastInsertId();
        $requete->closeCursor();
        return $lastId; //$affectedLines;
    }

    /**
     * @param $article
     * @return bool
     */
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

    /**
     * @param $idArticle
     * @return Articles
     */
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

        $oneArticle = new Articles($article);
        return $oneArticle;
    }

    /**
     * @param $rubrique
     * @return array
     */
    public function getArticlesByCategory($rubrique)
    {
        $articles = [];

        if ($rubrique != 'all') {
            $listArticles = $this->connection->prepare(
                '
            SELECT articles_id, titre, chapo, auteur,contenu, rubrique, date_creation, date_mise_a_jour 
            FROM articles
            WHERE rubrique = :rubrique 
            ORDER BY date_creation DESC'
            );
            $listArticles->execute([':rubrique' => $rubrique]);
            $listArticles = $listArticles->fetchAll();
        } else {
            $listArticles = $this->connection->prepare(
                '
            SELECT *
            FROM articles
            ORDER BY articles_id DESC'
            );
            $listArticles->execute();
        }


        foreach ($listArticles as $article) {
            $articles[] = new Articles($article);
        }

        return $articles;
    }

    /**
     * @param $idArticle
     * @return bool|\PDOStatement
     */
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
        } catch (\PDOException $e) {
            $errorException = ('Erreur dans deleteArticle : ' . $e->getMessage());
            header('Location: index.php?route=errorMessage&exception=' . $errorException);
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
}
