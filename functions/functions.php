<?php
use Model\PdoConstruct;

                  //*** Get an input value entered by user ***
    function getFormData($session,$key)
    {  //echo "getFormData : $key";
      if (!empty($_SESSION[$session] [$key]))
      {
        return htmlspecialchars($_SESSION[$session] [$key]);
        }
        else  
        {
            return null;
        }        

    }

//*** save all input value entered by user ***
//================ mettre dans services ou functions =================
 function saveFormData($index)
{

    foreach ($_POST as $key => $value)
    {
        $_SESSION[$index] [$key] = $value;

    }
}

    function generateToken()
    {

    //Create a "unique" token.
       return $token = bin2hex(openssl_random_pseudo_bytes(16));

    }

    function createUrlWithToken($token)
    {
        $userId = 1; // test only

        //Construct the URL.
        $url = "https://damirweb.com/oc/p5/myp5blog/index.php?route=verifEmail&token=$token&email=$email";

    //Build the HTML for the link.
        $urlLink = '<a href="' . $url . '">' . $url . '</a>';

    //Send the email containing the $link above.
        return $urlLink;
    }   



    // get user email and id from users table 
    function getUserEmailandId() // Nota : voir si doublon avec checkUserLogin($loginUser) de la classe AdminUsers ou checkUserRecord() de la classe Users
    {
        {
            $connection = new PdoConstruct;

            $userData = $this->connection->prepare('
                SELECT email, token
                FROM users
                WHERE id = $userId
                ');

            $userData->execute();

            $userEmail = $userData->fetch();

            return $userEmail;
        }
    }

function setFlash($titre, $message, $type) {
    $mess = [
        'titre' =>$titre,
        'message' => $message,
        'type' =>$type
    ];
    return $mess;
}

function flashMessage($mess)
{
    echo '<div class="container alerte alert-'.$mess['type'].'">' . $mess['titre'] . '
<button type="button" class="close" data-dismiss="alert">&times;</button>' . $mess['message'] .
        '</div>';
    unset($mess);
}