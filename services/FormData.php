<?php

namespace Services;

class FormData
{
    private static $formSession = [];

    /**
     * @param $data
     * @return null
     */
    public static function securizeFormFields($data)
    {
        $arrayField = null;
        foreach ($data as $key => $field) {
            $field = trim($field);
            $field = stripslashes($field);
            $field = htmlspecialchars($field);
            $arrayField[$key] = $field;
        }
        return $arrayField;
    }

    /**
     * @param $session
     * @param $key
     * @return string|null
     */
    public static function getFormData($session, $key)//*** Get an input value entered by user ***
    {
        if (!empty(self::$formSession[$session][$key])) {
            $value = self::$formSession[$session][$key];
            return $value;
        }
        return null;
    }

    /**
     * @param $index
     * @param $post
     */
    public static function saveFormData($index, $post)
    {
        foreach ($post as $key => $value) {
            self::$formSession[$index][$key] = $value;

        }
    }

    /**
     * @param $index
     * @param $post
     */
    public static function cleanFormData($index, $post)
    {
        foreach ($post as $key => $value) {
            self::$formSession[$index][$key] = "";
        }
    }


}