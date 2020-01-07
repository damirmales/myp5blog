<?php

function checkFormInputs($field)
{


// Tableau contenant les messages d'erreur lies a la validation de chaque
// champ du formulaire.
// On utilisera le titre du champ comme cle du tableau
    $errs = array();

    $titre = "";
    $chapo = "";
    $auteur = "";
    $contenu = "";


// S'il s'agit du premier affichage, le bouton submit n'a pas ete presse
// il n'y a pas de validation a effectuer. Sinon $field["submit"] n'est pas
// vide (et contient la valeur "Enregistrer")


    $titre = stripSlashes($field["titre"]);
    if (strlen($titre) == 0)
        $errs["titre"][] = "Le titre est obligatoire";

    if (strlen($titre) > 45)
        $errs["titre"][] = "Le titre ne doit pas exceder 45 c.";

    //$errs["titre"][] = (preg_match("/^[A-Za-z '-]+$/", $titre) ? true : "doit contenir seulement des caractères");

    $chapo = stripSlashes($field["chapo"]);
    if (strlen($chapo) == 0)
        $errs["chapo"][] = "Le chapo est obligatoire";

    if (strlen($chapo) > 45)
        $errs["chapo"][] = "Le chapo ne doit pas exceder 45 c.";
    $errs["chapo"][] = is_string($chapo) ? true : "doit contenir seulement des caractères";

    if (isset($field["auteur"])) {
        $auteur = stripSlashes($field["auteur"]);
        if (strlen($auteur) == 0)
            $errs["auteur"][] = "Le auteur est obligatoire";
        if (strlen($auteur) > 45)
            $errs["auteur"][] = "Le auteur ne doit pas exceder 45 c.";
    }

    $contenu = stripSlashes($field["contenu"]);
    if (strlen($contenu) == 0) {
        $errs["contenu"][] = "Le contenu est obligatoire";
    }
    echo '<pre>';
    var_dump($errs);

    if (count($errs) == 0) {
        // Les donnees du formulaires ont ete validee (pas d'erreur trouvee)
        // faire ce qui doit etre fait (envoi de mail, enregistrement en base)
        // et rediriger vers la page suivante
        // header("Location: pagesuivante.php");

        return count($errs);
        //die();
    } else {
        return $errs;
    }

}

/*
public function verifyEmptiness($post)

{
    return (!empty($post))?true:"null";
}


public function verifyString($post)
{
    return (preg_match("/^[A-Za-z '-]+$/",$post)?true:"doit contenir seulement des caractères");
}


public function verifyEmail($post)
{
    return (filter_var($post, FILTER_VALIDATE_EMAIL)?true:"doit être au format email : quidam@casa.fr");
}

*/



