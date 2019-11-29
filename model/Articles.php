<?php

namespace Model;

use Model\PdoConstruct;

/****** **************************************************************************
Cette classe gère la collecte des données pour afficher la liste des articles
et chaque article en particulier
 *************************************************************************************/
class Articles extends PdoConstruct
{
    private $id;
    private $titre;
    private $chapo;
    private $auteur;
    private $contenu;
    private $rubrique;
    private $date_creation;
    private $date_mise_a_jour;


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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre( $titre ): void
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * @param mixed $chapo
     */
    public function setChapo( $chapo ): void
    {
        $this->chapo = $chapo;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur( $auteur ): void
    {
        $this->auteur = $auteur;
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
    public function getRubrique()
    {
        return $this->rubrique;
    }

    /**
     * @param mixed $rubrique
     */
    public function setRubrique( $rubrique ): void
    {
        $this->rubrique = $rubrique;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * @param mixed $date_creation
     */
    public function setDateCreation( $date_creation ): void
    {
        $this->date_creation = $date_creation;
    }

    /**
     * @return mixed
     */
    public function getDateMiseAJour()
    {
        return $this->date_mise_a_jour;
    }

    /**
     * @param mixed $date_mise_a_jour
     */
    public function setDateMiseAJour( $date_mise_a_jour ): void
    {
        $this->date_mise_a_jour = $date_mise_a_jour;
    }





    /************ Add articles to database ***************/
    public function setArticleToDb()
    {
        $requete = $this->connection->prepare('
            INSERT INTO articles (articles_id,titre,chapo,auteur,contenu,rubrique,date_creation,date_mise_a_jour)
            VALUES (:id,:titre,:chapo,:auteur,:contenu,:rubrique,NOW(),NOW())
            ');
        $requete->bindValue(':id', NULL, \PDO::PARAM_INT);
        $requete->bindValue(':titre', $this->getTitre(), \PDO::PARAM_STR);
        $requete->bindValue(':chapo', $this->getChapo(), \PDO::PARAM_STR);
        $requete->bindValue(':auteur', $this->getAuteur(), \PDO::PARAM_STR);
        $requete->bindValue(':contenu', $this->getContenu(), \PDO::PARAM_STR);
        $requete->bindValue(':rubrique', $this->getRubrique(), \PDO::PARAM_STR);
        //$requete->bindValue(':date_creation', $this->getDateCreation(), \PDO::PARAM_INT);
        //$requete->bindValue(':date_mise_a_jour', $this->getDateMiseAJour(), \PDO::PARAM_INT);
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

        //--------------- get results into an object à' -------------------------
        //$listArticles->setFetchMode(\PDO::FETCH_CLASS| \PDO::FETCH_PROPS_LATE, 'Articles');
        //$listArticles->setFetchMode(\PDO::FETCH_CLASS,'Articles');

        //$articles = $listArticles->fetchAll();
        $articles = $listArticles->fetchAll(\PDO::FETCH_OBJ);// renvoi les attributs dans un objet
        $listArticles->closeCursor();
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
            ORDER BY date_creation DESC'
        );

        $listArticles->execute();
        $articles = $listArticles->fetchAll();
        return $articles;
    }

    //---------- efface l'article en fonction du numéro d'id fournit ----------

    public function deleteArticle($idArticle)
    {
        $commentaire = $this->connection->prepare('
            DELETE 
            FROM commentaires
            WHERE Articles_articles_id = :id');

        $commentaire->execute([ ':id' => $idArticle ] );

        $article = $this->connection->prepare('
            DELETE 
            FROM articles
            WHERE articles_id = :id');

        $article->execute([ ':id' => $idArticle ] );    

        return $article;
        
    }
}
