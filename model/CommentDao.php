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

        $requete->execute([':id' => $articleId]);
        $comments = $requete->fetchAll();
        return $comments;
    }

    /************ Add comments to database **************
     * @param $articleId
     * @param $comment
     * @return bool
     */

    public function addCommentsToDb($articleId,$comment)
    {


        $requete = $this->connection->prepare('
			INSERT INTO commentaires (commentaire_id,pseudo,contenu,date_ajout,validation,date_validation,Articles_articles_id)
			VALUES (:id,:pseudo,:contenu,NOW(),:valid, NOW(),:idart)
			');
        $requete->bindValue(':id', NULL, \PDO::PARAM_INT);
        $requete->bindValue(':pseudo', $comment->getPseudo(), \PDO::PARAM_STR);
        $requete->bindValue(':contenu', $comment->getContenu(), \PDO::PARAM_STR);
        $requete->bindValue(':valid', 0, \PDO::PARAM_INT);
        $requete->bindValue(':idart', $articleId, \PDO::PARAM_INT);

        $affectedLines = $requete->execute();

        return $affectedLines;

    }

    /************ Fetch list of comments from database ***************/

    public function getListComments()
    {
        $requete = $this->connection->prepare('
            
            SELECT commentaire_id, pseudo, B.contenu, date_ajout, validation
            FROM commentaires as B
      
            ORDER BY B . Articles_articles_id DESC'
        );
        $requete->execute();

        $comments = [];
        foreach ($requete as $comment) {
            $comments[] = new Comments($comment);
        }
       // echo '<pre> getlist'; var_dump($comments);
        return $comments;
    }

    //---------- efface le commentaire en fonction du numéro d'id fournit ----------

    public function deleteComment($idComment)
    {//echo '<pre> deleteComment'; var_dump($idComment);
        $commentaire = $this->connection->prepare('
            DELETE 
            FROM commentaires
            WHERE Articles_articles_id = :id');

        $commentaire->execute([':id' => $idComment]);

        return $commentaire;

    }

    public function validateComment($idComment)
    {
        $commentaire = $this->connection->prepare('
            UPDATE  commentaires
            SET validation = 1 
            WHERE commentaire_id = :id');

        $commentaire->execute([':id' => $idComment]);

    }

}