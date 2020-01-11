<?php

namespace Services;

class Messages
{
    /**
     * @param $titre
     * @param $message
     * @param $type
     * @return array
     */
    public static function setFlash($titre, $message, $type)
    {
        $mess = [
            'titre' => $titre,
            'message' => $message,
            'type' => $type
        ];
        return $mess;
    }


    /**
     * @param $mess
     */
    public static function flashMessage2($mess)//display one item
    {
        echo '<div class="container alerte alert-' . $mess['type'] . '">' . $mess['titre'] . '
<button type="button" class="close" data-dismiss="alert">&times;</button>' . $mess['message'] .
            '</div>';
        unset($mess);
    }

    /**
     * @param $mess
     */
    public static function flashMessage($mess)
    {
        foreach ($mess as $msg) {
            echo '<div class="container alerte alert-' . $msg['type'] . '">' . $msg['titre'] . '
<button type="button" class="close" data-dismiss="alert">&times;</button>' . $msg['message'] .
                '</div>';
            unset($mess);
        }

    }
}