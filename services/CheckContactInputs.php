<?php


namespace Services;


class CheckContactInputs
{

    public function checkContactInputs($field)
    {
        $errs = array();
        $errMessage = [];

        $nom = htmlspecialchars($field["nom"]);
        $errs["nom"] = $this->checkNom($nom);

        $prenom = htmlspecialchars($field["prenom"]);
        $errs["prenom"] = $this->checkPrenom($prenom);

        $email = htmlspecialchars($field["email"]);
        $errs["email"] = $this->checkEmail($email);

        $message = htmlspecialchars($field["message"]);
        $errs["message"] = $this->checkContenu($message);

        if (!empty($errs)) {
            foreach ($errs as $item => $value) {
                if ($value != null) {
                    $errMessage[$item] = Messages::setFlash('Attention !', $value, 'warning');
                }
            }
        }

        if (count($errMessage) != 0) {
            return $errMessage;
        } else return null;
    }

    public function checkNom($nom)
    {
        $err = null;
        if (strlen($nom) === 0) {
            $err = "Le nom est obligatoire";
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

    public
    function checkContenu($message)
    {
        $err = null;
        if (strlen($message) == 0) {
            $err = "Le message est obligatoire";
        }
        return $err;
    }

}