<?php
namespace Model;


class CommentDao extends PdoConstruct
{
    /************ Fetch comments from database ***************/

    public function getCommentsFromDb($articleId)
    {
        $requete = $this->connection->prepare('
			SELECT commentaire_id, pseudo, contenu, date_ajout 
			FROM commentaires
			WHERE  Articles_articles_id = :id AND validation = 1
			ORDER BY date_ajout DESC'
        );

        $requete->execute( [ ':id' => $articleId ] );
        $comments = $requete->fetchAll();
        return $comments;
    }

    /************ Add comments to database ***************/

    public function addCommentsToDb($articleId)
    {


        $requete = $this->connection->prepare('
			INSERT INTO commentaires (commentaire_id,pseudo,contenu,date_ajout,validation,date_validation,Articles_articles_id)
			VALUES (:id,:pseudo,:contenu,NOW(),:valid, NOW(),:idart)
			');
        $requete->bindValue(':id', NULL, \PDO::PARAM_INT);
        $requete->bindValue(':pseudo', $this->getPseudo(), \PDO::PARAM_STR);
        $requete->bindValue(':contenu', $this->getContenu(), \PDO::PARAM_STR);
        $requete->bindValue(':valid', 1, \PDO::PARAM_INT);
        $requete->bindValue(':idart', $articleId, \PDO::PARAM_INT);

        $affectedLines = $requete->execute();

        return $affectedLines;

    }

    /************ Fetch list of comments from database ***************/

    public function getListComments()
    {
        $requete = $this->connection->prepare('
			SELECT commentaire_id, pseudo, contenu, date_ajout 
			FROM commentaires
		    ORDER BY date_ajout DESC'
        );

        $requete->execute();

       // $listComments = $requete->fetchAll(\PDO::FETCH_ASSOC);

        $comments = [];
        foreach ($requete as $comment) {
            $comments[] = new Comments($comment);
        }

        return $comments;

    }



}