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
        return $this->email;
    }

    /**
     * @param mixed $role
     */
    public function setRole( $role ): void
    {
        $this->email = $role;
    }

    /**************************************
     * @return mixed
     */
    public function getSatut()
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


 	//----- Check if user is registered------------
			public function checkUserRecord()
			{
				
				$userRecord = $this->connection->prepare('
					SELECT id,nom,email
					FROM Users
					');

				$userRecord->execute();
				$user = $userRecord->fetch();
				
				return $user;
			}
//----- Check if user's login is in the DB ------------

			public function checkUserLogin($loginUser)
			{
				
				$userData = $this->connection->prepare('
					SELECT *
					FROM users
					WHERE login = :loginUser
					');

				$userData->execute( [ ':loginUser' => $loginUser ] );
				
				$user = $userData->fetch();

				return $user;

			}

	/************ Add user to database ***************/

			public function addUserToDb()
			{

				$requete = $this->connection->prepare('
					INSERT INTO users (id,nom,prenom,email,role,statut,token,login,password)
					VALUES (:id,:nom,:prenom,:email,:role,:statut,:token,:login,:password)
					');
				$requete->bindValue(':id', NULL, \PDO::PARAM_INT);
				$requete->bindValue(':nom', $this->getNom(), \PDO::PARAM_STR);
				$requete->bindValue(':prenom', $this->getPrenom(), \PDO::PARAM_STR);
				$requete->bindValue(':email', $this->getEmail(), \PDO::PARAM_STR);
				$requete->bindValue(':role', $this->getRole(), \PDO::PARAM_STR);
				$requete->bindValue(':statut', $this->getStatut(), \PDO::PARAM_INT);
				$requete->bindValue(':token', $this->getToken(), \PDO::PARAM_STR);
				$requete->bindValue(':login', $this->getLogin(), \PDO::PARAM_STR);
				$requete->bindValue(':password', $this->hashPassword($this->getPassword()), \PDO::PARAM_STR);

				$affectedLines = $requete->execute();

				return $affectedLines;

			}
		/** encrypt password ********/
			private function hashPassword($pswd)
			{
				$pwd_hashed = password_hash($pswd, PASSWORD_DEFAULT);
				return $pwd_hashed;

			}

 }
