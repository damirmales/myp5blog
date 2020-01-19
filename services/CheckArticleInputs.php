<?php

namespace Services;

class CheckArticleInputs
{

    public function checkArticleInputs($field)
    {
        $errs = array();
        $errMessage = [];
        $titre = htmlspecialchars($field["titre"]);
        $errs["titre"] = $this->checkTitre($titre);

        $chapo = htmlspecialchars($field["chapo"]);
        $errs["chapo"] = $this->checkChapo($chapo);

        $auteur = htmlspecialchars($field["auteur"]);
        $errs["auteur"] = $this->checkAuteur($auteur);

        $contenu = htmlspecialchars($field["contenu"]);
        $errs["contenu"] = $this->checkContenu($contenu);


        foreach ($errs as $item => $value) {

            if ($value != null) {

                $errMessage[$item] = Messages::setFlash('Attention !', $value, 'warning');
            }
        }


        if (count($errMessage) != 0) {
            return $errMessage;
        } else { return null;
        }
    }

    public function checkTitre($titre)
    {
        $err = null;
        if (strlen($titre) === 0) {
            $err = "Le titre est obligatoire";
        } elseif (strlen($titre) > 45) {
            $err = "Le titre ne doit pas exceder 45 c.";
        } elseif (!preg_match("/^[A-Za-z '-]+$/", $titre)) {
            $err = "Le titre doit contenir seulement des caractères";
        }

        return $err;


    }

    public function checkChapo($chapo)
    {
        $err = null;
        if (strlen($chapo) == 0) {
            $err = "Le chapo est obligatoire";
        } elseif (strlen($chapo) > 45) {
            $err = "Le chapo ne doit pas exceder 45 c.";
        }
        return $err;
    }

    public function checkAuteur($auteur)
    {
        $err = null;
        if (strlen($auteur) == 0) {
            $err = "Le auteur est obligatoire";
        } elseif (strlen($auteur) > 45) {
            $err = "Le auteur ne doit pas exceder 45 c.";
        }
        return $err;
    }

    public function checkContenu($contenu)
    {
        $err = null;
        if (strlen($contenu) == 0) {
            $err = "Le contenu est obligatoire";
        }
        return $err;
    }

}


