<?php

/**
 * @param $session
 * @param $key
 * @return string|null
 */
function getFormData($session, $key)//*** Get an input value entered by user ***
{
    if (!empty($_SESSION[$session][$key])) {
        $value = $_SESSION[$session][$key];
        unset($_SESSION[$session][$key]);
        return $value;
    }
    return null;
}

//*** save all input value entered by user ***
//================ mettre dans services ou functions =================
function saveFormData($index, $post)
{
    foreach ($post as $key => $value) {
        $_SESSION[$index][$key] = $value;
    }

}

//*** Clean all input value entered by user ***
//================ mettre dans services ou functions =================
function cleanFormData($index, $post)
{
    foreach ($post as $key => $value) {
        $_SESSION[$index][$key] = "";
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
    foreach ($mess as $msg) {
        echo '<div class="container alerte alert-' . $msg['type'] . '">' . $msg['titre'] . '
<button type="button" class="close" data-dismiss="alert">&times;</button>' . $msg['message'] .
            '</div>';
        unset($mess);
    }
}


