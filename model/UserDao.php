<?php
namespace Model;


class UserDao extends PdoConstruct
{

    //----- Check if user is registered------------
    public function checkUserRecord($email)
    {

        $userRecord = $this->connection->prepare('
					SELECT id,nom,email
					FROM users
					WHERE email = :email
					');
        // On lie la variable $email définie au-dessus au paramètre :email de la requête préparée
        $userRecord->bindValue(':email', $email, \PDO::PARAM_STR);

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

    public function addUserToDb($user)
    {

        $requete = $this->connection->prepare('
					INSERT INTO users (id,nom,prenom,email,role,statut,token,login,password)
					VALUES (:id,:nom,:prenom,:email,:role,:statut,:token,:login,:password)
					');
        $requete->bindValue(':id', NULL, \PDO::PARAM_INT);
        $requete->bindValue(':nom', $user->getNom(), \PDO::PARAM_STR);
        $requete->bindValue(':prenom', $user->getPrenom(), \PDO::PARAM_STR);
        $requete->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $requete->bindValue(':role', $user->getRole(), \PDO::PARAM_STR);
        $requete->bindValue(':statut', 0, \PDO::PARAM_INT);
        $requete->bindValue(':token', $user->getToken(), \PDO::PARAM_STR);
        $requete->bindValue(':login', $user->getLogin(), \PDO::PARAM_STR);
        $requete->bindValue(':password', $this->hashPassword($user->getPassword()), \PDO::PARAM_STR);

        $affectedLines = $requete->execute();

        return $affectedLines;

    }
    /** encrypt password ********/
    private function hashPassword($pswd)
    {
        $pwd_hashed = password_hash($pswd, PASSWORD_DEFAULT);
        return $pwd_hashed;

    }

    public function validateUser($idUser)
    {
        $commentaire = $this->connection->prepare('
            UPDATE  users
            SET statut = 1 
            WHERE id = :id');

        $commentaire->execute([':id' => $idUser]);

    }
}