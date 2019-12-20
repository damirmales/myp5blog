<?php

use Model\PdoConstruct;

//*** Get an input value entered by user ***
/**
 * @param $session
 * @param $key
 * @return string|null
 */
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

/**
 * @return string
 */
function generateToken()
{

    //Create a "unique" token.
    return $token = bin2hex(openssl_random_pseudo_bytes(16));

}

/**
 * @param $token
 * @param $email
 * @return string
 */
function createUrlWithToken($token, $email)
{
    $userId = 1; // test only

    //Construct the URL.
    $url = "https://damirweb.com/oc/p5/myp5blog/index.php?route=verifEmail&token=$token&email=$email";

    //Build the HTML for the link.
    $urlLink = '<a href="' . $url . '">' . $url . '</a>';

    //Send the email containing the $link above.
    return $urlLink;
}


/**
 * @param $titre
 * @param $message
 * @param $type
 * @return array
 */
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


