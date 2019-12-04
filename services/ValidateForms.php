<?php
namespace Services;

class ValidateForms
{
//********** Properties **************
protected $nom;
protected $prenom;
    protected $email;
    protected $login;
    protected $password;
    protected $message;


    //********** Constructor **************

    public function __construct()
    {
        
    }

    public function verifyEmptiness($post)

 {
    return (!empty($post))?true:"null";
}

public function verifyString($post)
{
    return (preg_match("/^[A-Za-z '-]+$/",$post)?true:"doit contenir seulement des caractères");
}

public function verifyEmail($post)
{
    return (filter_var($post, FILTER_VALIDATE_EMAIL)?true:"doit être au format email : quidam@casa.fr");
}


}




