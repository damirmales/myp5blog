<?php

 function securizeFormFields($data)
{ 
    foreach ($data as $key => $field)
    {
        $field = trim($field);
        $field = stripslashes($field);
        $field = htmlspecialchars($field);

        $arrayField[$key]=$field;
    }
    return $arrayField;
}

