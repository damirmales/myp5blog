<?php

namespace Services;

class CheckArticleInputs
{

    public function checkArticleInputs($field)
    {
        $errs = array();
        $ErrorMessage = [];

        $titre = stripSlashes($field["titre"]);


        if (strlen($titre) == 0) {
            $errs["titre"] = "Le titre est obligatoire";
        }

        if (strlen($titre) > 45) {
            $errs["titre"] = "Le titre ne doit pas exceder 45 c.";
        }
        if (!preg_match("/^[A-Za-z '-]+$/", $titre)) {
            $errs["titre"] = "Le titre doit contenir seulement des caractères";
        }

        $chapo = stripSlashes($field["chapo"]);
        if (strlen($chapo) == 0) {
            $errs["chapo"] = "Le chapo est obligatoire";
        }
        if (strlen($chapo) > 45) {
            $errs["chapo"] = "Le chapo ne doit pas exceder 45 c.";
        }

        if (isset($field["auteur"])) {
            $auteur = stripSlashes($field["auteur"]);
            if (strlen($auteur) == 0) {
                $errs["auteur"] = "Le auteur est obligatoire";
            }

            if (strlen($auteur) > 45) {
                $errs["auteur"] = "Le auteur ne doit pas exceder 45 c.";
            }
        }

        $contenu = stripSlashes($field["contenu"]);
        if (strlen($contenu) == 0) {
            $errs["contenu"] = "Le contenu est obligatoire";
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


