<?php
namespace Model;
use Model\PdoConstruct;

/*********************************************/
/************ Manage comments ***************/
/*********************************************/

class Comments extends PdoConstruct
{

 	protected $id;
    protected $pseudo;
    protected $contenu;
    protected $date_ajout;
    protected $validation;
    protected $date_validation;
    protected $Articles_articles_id;

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


    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }


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
		$requete->bindValue(':valid', 0, \PDO::PARAM_INT);
		$requete->bindValue(':idart', $articleId, \PDO::PARAM_INT);

		$affectedLines = $requete->execute();

		return $affectedLines;

	}
	
}		



