<?php


namespace Services;


class CheckUserInputs
{

    public function checkUserInputs($field)
    {
        $errs = array();
        $ErrorMessage = [];

        $nom = htmlspecialchars($field["nom"]);


        if (empty($nom)) {
            $errs["nom"] = "Le nom est obligatoire";
        } elseif (strlen($nom) > 45) {
            $errs["nom"] = "Le nom ne doit pas exceder 45 c.";
        } elseif (!preg_match("/^[A-Za-z '-]+$/", $nom)) {
            $errs["nom"] = "Le nom doit contenir seulement des caractères";
        }

        $prenom = htmlspecialchars($field["prenom"]);
        if (strlen($prenom) == 0) {
            $errs["prenom"] = "Le prenom est obligatoire";
        } elseif (strlen($prenom) > 45) {
            $errs["prenom"] = "Le prenom ne doit pas exceder 45 c.";
        }

        if (isset($field["email"])) {
            $email = htmlspecialchars($field["email"]);
            if (strlen($email) == 0) {
                $errs["email"] = "L'email est obligatoire";
            }
            if (strlen($email) > 55) {
                $errs["email"] = "L'email ne doit pas exceder 55 c.";
            }
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errs["email"] = "l'email doit être selon format :bibi@fricotin.fr";
            }
        }

        $login = htmlspecialchars($field["login"]);
        if (strlen($login) == 0) {
            $errs["login"] = "Le login est obligatoire";
        }

        $password = htmlspecialchars($field["password"]);
        if (empty($password)) {
            $errs['password'] = "Manque le Mot de passe ";
        } elseif (strlen($password) < 2) {
            $errs['password'] = "Le mot de passe doit avoir plus de 2 caractères!";
        }
        $password2 = htmlspecialchars($field["password"]);
        if (empty($password2)) {
            $errs['password2'] = "Il faut répéter le mot de passe ";
        }

        if (($password) !== ($password2)) {
            $errs['password12'] = "Les champs des mots de passe doivent être identiques";
        }

        if (($errs) != null) {
            foreach ($errs as $item => $value) {
                $ErrorMessage[$item] = Messages::setFlash("Attention !", $value, 'warning');
            }
        }

        if (count($errs) != 0) {
            return $ErrorMessage;
        } else return null;
    }

}