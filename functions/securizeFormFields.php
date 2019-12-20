<?php

function securizeFormFields($data)
{
    $arrayField = null;
    foreach ($data as $key => $field)
    {
        $field = trim($field);
        $field = stripslashes($field);
        $field = htmlspecialchars($field);

        $arrayField[$key]=$field;
    }

    return $arrayField;
}

