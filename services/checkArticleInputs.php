<?php


function verifyEmptiness($value, $name)
{

    if (strlen($value) == 0) {
        $text = "Le " . $name . " est obligatoire";
        var_dump($text);
        die();
        return $text;

    } else return null;


}

function checkArticleInputs($field)
{
    $errs = array();

    $titre = stripSlashes($field["titre"]);
    //$errs["titre"] = verifyEmptiness($titre, "titre");

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

    if (count($errs) != 0) {
        return $errs;
    } else return null;
}


