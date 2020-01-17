<?php


namespace Services;


class CheckUserInputs
{

    public function checkUserInputs($field)
    {
        $errs = array();
        $ErrorMessage = [];

        $nom = htmlspecialchars($field["nom"]);
        $errs["nom"] = $this->checkNom($nom);

        $prenom = htmlspecialchars($field["prenom"]);
        $errs["prenom"] = $this->checkPrenom($prenom);

        $email = htmlspecialchars($field["email"]);
        $errs["email"] = $this->checkEmail($email);

        $login = htmlspecialchars($field["login"]);
        $errs["login"] = $this->checkLogin($login);

        $password = htmlspecialchars($field["password"]);
        $errs["password"] = $this->checkPassword($password);

        $password2 = htmlspecialchars($field["password2"]);
        $errs["password2"] = $this->checkPassword2($password2);


        $errs["password12"] = $this->checkPassword12($password, $password2);

        if (!empty($errs)) {
            foreach ($errs as $item => $value) {
                if ($value != null) {
                    $ErrorMessage[$item] = Messages::setFlash('Attention !', $value, 'warning');
                }
            }
        }

        if (count($errs) != 0) {
            return $ErrorMessage;
        } else { return null;
        }
    }

    public function checkNom($nom)
    {
        $err = null;
        if (strlen($nom) === 0) {
            $err = "Le nom est obligatoireddddd";
        } elseif (strlen($nom) > 45) {
            $err = "Le nom ne doit pas exceder 45 c.";
        } elseif (!preg_match("/^[A-Za-z '-]+$/", $nom)) {
            $err = "Le nom doit contenir seulement des caractères";
        }
        return $err;
    }

    public function checkPrenom($prenom)
    {
        $err = null;
        if (strlen($prenom) == 0) {
            $err = "Le chapo est obligatoire";
        } elseif (strlen($prenom) > 45) {
            $err = "Le prenom ne doit pas exceder 45 c.";
        }
        return $err;
    }

    public function checkEmail($email)
    {
        $err = null;
        if (strlen($email) == 0) {
            $err = "Le email est obligatoire";
        } elseif (strlen($email) > 45) {
            $err = "Le email ne doit pas exceder 45 c.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err = "L'email doit être selon format :bibi@fricotin.fr";
        }
        return $err;
    }

    public function checkLogin($login)
    {
        $err = null;
        $login = htmlspecialchars($login);
        if (strlen($login) == 0) {
            $err = "Le login est obligatoire";
        }
        return $err;
    }

    public function checkPassword($password)
    {
        $err = null;
        $password = htmlspecialchars($password);
        if (empty($password)) {
            $err = "Manque le Mot de passe ";
        } elseif (strlen($password) < 2) {
            $err = "Le mot de passe doit avoir plus de 2 caractères!";
        }
        return $err;
    }

    public function checkPassword2($password2)
    {
        $err = null;
        $password2 = htmlspecialchars($password2);
        if (empty($password2)) {
            $err = "Il faut répéter le mot de passe ";
        }
        return $err;
    }

    public function checkPassword12($password, $password2)
    {
        $err = null;
        if (($password) !== ($password2)) {
            $err = "Les champs des mots de passe doivent être identiques";
        }
        return $err;
    }


}
