<?php
/************** use in function publishComments ********************/
use Model\Comments;
use Model\Users;

if (empty($commentErrorMessage))
{
    echo "pas d'erreur c'est lessieur" ;

    //instancier la classe qui recupère les données des utilisateurs enregistrés
    $user = new Users();
    $checkUser = $user->checkUserRecord(); // id de l'article
    var_dump($checkUser['nom']);
    //verifier si l'utilisateur ayant soumit le commentaire est enregistré
    if (($checkUser['nom'] == $nom) && ($checkUser['email'] == $email))
    {
        //Ajouter le commentaire et le pseudo si le visiteur est enregistré
        $newcomment = new Comments();

        $newcomment->setPseudo($nom);
        $newcomment->setComment($comment);

        $affectedLines = $newcomment->addCommentsToDb($articleId); // id de l'article

        if ($affectedLines === false) {
            //die('Impossible d\'ajouter le commentaire !');
            exit('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?route=article&id=' . $articleId);
            exit;
        }

    }
    else
    { echo 'vous n\etes pas membre pour pouvoir commenter';
        /*header('Location: index.php');
        exit();*/
    }
/************** end - use in function publishComments ********************/

