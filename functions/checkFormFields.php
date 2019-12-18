<?php


function checkFormFields($field, $index, $length)
{global  $errMsg ;
    if (strlen($field) > $length) {

        $errMsg = "Le ".$index." ne doit pas exceder 45 c.\n\r";

    }

    if (!empty($field) && !(preg_match("/^[A-Za-z '-]+$/", $field) ? true : false)) {

        $errMsg .=  "\n\r  Le ".$index."  doit contenir seulement des caractères";
    }

    return $errMsg;

}



