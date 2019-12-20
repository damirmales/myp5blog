<?php

use Model\PdoConstruct;

//*** Get an input value entered by user ***
function getFormData($session, $key)
{
    if (!empty($_SESSION[$session][$key])) {

        $value = $_SESSION[$session][$key];

        unset($_SESSION[$session][$key]);
        return htmlspecialchars($value);
    }
    return null;
}

//*** save all input value entered by user ***
//================ mettre dans services ou functions =================
function saveFormData($index)
{
    $post =  securizeFormFields($_POST);
    foreach ($post as $key => $value) {
        $_SESSION[$index] [$key] = $value;

    }
}

function generateToken()
{

    //Create a "unique" token.
    return $token = bin2hex(openssl_random_pseudo_bytes(16));

}

function createUrlWithToken($token,$email)
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

        $userData = $this->connection->prepare(
            '
                SELECT email, token
                FROM users
                WHERE id = $userId
                '
        );

        $userData->execute();

        $userEmail = $userData->fetch();

        return $userEmail;
    }
}

function setFlash($titre, $message, $type)
{
    $mess = [
        'titre' => $titre,
        'message' => $message,
        'type' => $type
    ];
    return $mess;
}

function flashMessage2($mess)
{
    echo '<div class="container alerte alert-' . $mess['type'] . '">' . $mess['titre'] . '
<button type="button" class="close" data-dismiss="alert">&times;</button>' . $mess['message'] .
        '</div>';
    unset($mess);
}

function flashMessage($mess)
{
    foreach ($mess as $msg)
    {
        echo '<div class="container alerte alert-' . $msg['type'] . '">' . $msg['titre'] . '
<button type="button" class="close" data-dismiss="alert">&times;</button>' . $msg['message'] .
        '</div>';
        unset($mess);

    }

}

function checkDouble($field)
{


}
