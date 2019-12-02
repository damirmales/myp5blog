<?php
namespace Model;
//require __DIR__ . '/vendor/autoload.php';
//require 'vendor/autoload.php';

class Emails
{

	public function sendEmail()
	{

		$prenom = $_POST['prenom'];
		$nom = $_POST['nom']; 
		$email = $_POST['email'];
		$message = $_POST['message'].' '; 
		$message   .= '$email : '.$email;
		$message   .= '$nom : '. $nom ;


		$emailTo = "damir@romandie.com";
		$subject = "Contact";
		$emailFrom = $_POST['email']; 

		$headers   = 'MIME-Version: 1.0' . "\r\n";
		$headers  .= 'Content-type: text/html; charset=UTF-8' . "\r\n";


		// envoi email 
		$success = mail($emailTo, $subject, $message, $headers);
		return $success;	

	}


	public function swiftMailer()
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

	}


}