<?php
namespace Services;

class ValidateForms
{

 public function verifyEmptiness($post)

 {
    return (!empty($post))?true:"null";
}

public function verifyString($post)
{
    return (preg_match("/^[A-Za-z '-]+$/",$post)?true:"pas string");
}

public function verifyEmail($post)
{
    return (filter_var($post, FILTER_VALIDATE_EMAIL)?true:"pas email");
}


}




