<?php
namespace Model;
use Model\PdoConstruct;

class Users extends PdoConstruct
 {

	
	private $id;
    private $nom;
    private $prenom;
    private $email;
    private $role;
    private $statut;
    private $token;
    private $login;
    private $password;


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


    /***************************************
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

    /**************************************
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom( $nom ): void
    {
        $this->nom = $nom;
    }

    /**************************************
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom( $prenom ): void
    {
        $this->prenom = $prenom;
    }

    /**************************************
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail( $email ): void
    {
        $this->email = $email;
    }

    /**************************************
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole( $role ): void
    {
        $this->role = $role;
    }

    /**************************************
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut( $statut ): void
    {
        $this->statut = $statut;
    }

    /**************************************
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken( $token ): void
    {
        $this->token = $token;
    }

    /**************************************
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin( $login ): void
    {
        $this->login = $login;
    }

    /**************************************
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword( $password ): void
    {
        $this->password = $password;
    }








 }
