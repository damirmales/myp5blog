<?php
namespace Services;
//require __DIR__ . '/vendor/autoload.php';
//require 'vendor/autoload.php';

class Emails
{
	private $nom;
    private $prenom;
    private $email;
    private $message;

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
    public function setNom( $nom ): void
    {
        $this->nom = $nom;
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
    public function setPrenom( $prenom ): void
    {
        $this->prenom = $prenom;
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
    public function setEmail( $email ): void
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
    public function setMessage( $message ): void
    {
        $this->message = $message;
    }


	public function sendEmail()
	{
		$prenom = $this->getPrenom('prenom');
		$nom = $this->getNom('nom'); 
		$email = $this->getEmail('email');

		$message   = 'email : '.$email.' - ';
		$message   .= 'nom : '.$prenom.' '.$nom." - " ;
        $message .= 'message : '.$this->getMessage('message');

		$emailTo = "damir@romandie.com";
		$subject = "Contact";
		$emailFrom = $this->getEmail('email'); 

		$headers   = 'MIME-Version: 1.0' . "\r\n";
		$headers  .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

		//---- envoi email
		$success = mail($emailTo, $subject, $message, $headers);

       // echo '<pre>'; var_dump($success);
        //$_SESSION["contactForm"] = "email  envoyé";
		return $success;	

	}
	
//---- send email with token to register a new user ----------
		public function tokenEmail($userEmail,$UrlToken)
	{

		$prenom = $this->getPrenom('prenom');
		$nom = $this->getNom('nom'); 
		$email = $this->getEmail('email');
		$message   = 'email : '.$userEmail;
		$message   .= 'token : '. $UrlToken ;


		$emailTo = $userEmail;
		$subject = "confirmez votre email";
		$emailFrom = $this->getEmail('email'); 

		$headers   = 'MIME-Version: 1.0' . "\r\n";
		$headers  .= 'Content-type: text/html; charset=UTF-8' . "\r\n";


		// envoi email 
		$success = mail($emailTo, $subject, $message, $headers);
		return $success;	

	}


	/*public function swiftMailer()
	{

// Create the Transport
		$transport = (new \Swift_SmtpTransport('smtp.gmail.com', 25))
		//$transport = (new \Swift_SmtpTransport('mail07.lwspanel.com', 465))
		->setUsername('your username')
		->setPassword('your password')
		;

// Create the Mailer using your created Transport
		$mailer = new \Swift_Mailer($transport);

// Create a message
		$message = (new \Swift_Message('Wonderful Subject'))
		->setFrom(['john@doe.com' => 'John Doe'])
		->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
		->setBody('Here is the message itself')
		;

// Send the message
		$result = $mailer->send($message);

	} */


}