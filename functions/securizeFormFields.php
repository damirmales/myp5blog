<?php
// define variables and set to empty values
/*$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = securizeFormFields($_POST["name"]);
    $email = securizeFormFields($_POST["email"]);
    $website = securizeFormFields($_POST["website"]);
    $comment = securizeFormFields($_POST["comment"]);
    $gender = securizeFormFields($_POST["gender"]);

    foreach ($post as $field)
    {
        $this->securizeFormFields($field);
        echo $this->securizeFormFields($field);

    }

}*/

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

