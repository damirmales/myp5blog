<?php
namespace Model;
use Model\PdoConstruct;

/*********************************************/
/************ Manage comments ***************/
/*********************************************/

class Comments extends PdoConstruct
{

 	private $id;
    private $pseudo;
    private $contenu;
    private $date_ajout;
    private $validation;
    private $date_validation;
    private $Articles_articles_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId( $id ): void
    {
        $this->id = $id;
    }

     /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo( $pseudo ): void
    {
        $this->pseudo = $pseudo;
    }
 /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu( $contenu ): void
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getDate_ajout()
    {
        return $this->date_ajout;
    }

    /**
     * @param mixed $date_ajout
     */
    public function setDate_ajout( $date_ajout ): void
    {
        $this->date_ajout = $date_ajout;
    }

     /**
     * @return mixed
     */
    public function getValidation()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $validation
     */
    public function setValidation( $validation ): void
    {
        $this->validation = $validation;
    }
     /**
     * @return mixed
     */
    public function getDate_validation()
    {
        return $this->date_validation;
    }

    /**
     * @param mixed $date_validation
     */
    public function setDate_validation( $date_validation ): void
    {
        $this->date_validation = $date_validation;
    }


	/************ Fetch comments from database ***************/


	public function getCommentsFromDb($articleId)
	{

	
		$requete = $this->connection->prepare('
			SELECT commentaire_id, pseudo, contenu, date_ajout 
			FROM commentaires
			WHERE  Articles_articles_id = :id
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
	
}		



