<?php


namespace Services;


class FormData
{
    /**
     * @param $session
     * @param $key
     * @return string|null
     */
    public static function getFormData($session, $key)//*** Get an input value entered by user ***
    {
        if (!empty($_SESSION[$session][$key])) {
            $value = $_SESSION[$session][$key];
            return $value;
        }
        return null;
    }

//*** save all input value entered by user ***
//================ mettre dans services ou functions =================
    /**
     * @param $index
     * @param $post
     */
    public static function saveFormData($index, $post)
    {
        foreach ($post as $key => $value) {
            $_SESSION[$index][$key] = $value;
        }
    }

//*** Clean all input value entered by user ***
//================ mettre dans services ou functions =================
    /**
     * @param $index
     * @param $post
     */
    public static function cleanFormData($index, $post)
    {
        foreach ($post as $key => $value) {
            $_SESSION[$index][$key] = "";
        }
    }
}