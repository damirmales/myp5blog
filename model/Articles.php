<?php
namespace Model;

/****** **************************************************************************
Cette classe gère les données liées à l'affichage des articles
 *************************************************************************************/
class Articles
{
    protected $articles_id;
    protected $titre;
    protected $chapo;
    protected $auteur;
    protected $contenu;
    protected $rubrique;
    protected $date_creation;
    protected $date_mise_a_jour;


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
    public function getArticles_id()
    {
        return $this->articles_id;
    }

    /**
     * @param mixed $articles_id
     */
    public function setArticles_id( $id ): void
    {
        $this->articles_id = $id;
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
    public function getDate_creation()
    {
        return $this->date_creation;
    }

    /**
     * @param mixed $date_creation
     */
    public function setDate_creation( $date_creation ): void
    {
        $this->date_creation = $date_creation;
    }

    /**
     * @return mixed
     */
    public function getDate_mise_a_jour()
    {
        return $this->date_mise_a_jour;
    }

    /**
     * @param mixed $date_mise_a_jour
     */
    public function setDate_mise_a_jour( $date_mise_a_jour ): void
    {
        $this->date_mise_a_jour = $date_mise_a_jour;
    }






}
