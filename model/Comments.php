<?php
namespace Model;

/*********************************************/
/************
 * 
 * Manage comments 
 ***************/
/*********************************************/

class Comments
{

    protected $commentaire_id;
    protected $pseudo;
    protected $contenu;
    protected $date_ajout;
    protected $validation;
    protected $date_validation;


    /**
     * @return mixed
     */
    public function getCommentaire_id()
    {
        return $this->commentaire_id;
    }

    /**
     * @param mixed $commentaire_id
     */
    public function setCommentaire_id( $commentaire_id ): void
    {
        $this->commentaire_id = $commentaire_id;
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
        return $this->validation;
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

            if (method_exists($this, $method)) {
                $this->$method($value);

            }
        }
    }

    
}        



