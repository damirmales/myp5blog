<?php

namespace Services;


class Emails
{
    private $nom;
    private $prenom;
    private $email;
    private $message;

    public function sendEmail()
    {
        $prenom = $this->getPrenom();
        $nom = $this->getNom();
        $email = $this->getEmail();

        $message = 'email : ' . $email . ' - ';
        $message .= 'nom : ' . $prenom . ' ' . $nom . " - ";
        $message .= 'message : ' . $this->getMessage();

        $emailTo = "damir@romandie.com";
        $subject = "Contact";
        $emailFrom = $this->getEmail();

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

        //---- envoi email
        $success = mail($emailTo, $subject, $message, $headers);
        return $success;
    }

    /**************************************
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**************************************
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**************************************
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**************************************
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    //---- send email with token to register a new user ----------
    public function tokenEmail($userEmail, $UrlToken)
    {
        $prenom = $this->getPrenom('prenom');
        $nom = $this->getNom('nom');
        $email = $this->getEmail('email');
        $message = 'email : ' . $userEmail;
        $message .= 'token : ' . $UrlToken;
        $emailTo = $userEmail;
        $subject = "confirmez votre email";
        $emailFrom = $this->getEmail('email');

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        // envoi email 
        $success = mail($emailTo, $subject, $message, $headers);
        return $success;
    }

    /**
     * @return string
     */
    public static function generateToken()
    {
        //Create a "unique" token.
        return $token = bin2hex(openssl_random_pseudo_bytes(16));
    }

    /**
     * @param $token
     * @param $email
     * @return string
     */
    public static function createUrlWithToken($token, $email)
    {
        // Construct the URL.
        $url = "https://damirweb.com/oc/p5/myp5blog/index.php?route=verifEmail&token=$token&email=$email";

        //Build the HTML for the link.
        $urlLink = '<a href="' . $url . '">' . $url . '</a>';
        //Send the email containing the $link above.
        return $urlLink;
    }
}
