<?php
namespace Model;

class Emails
{

	public function sendEmail()
	{

		$prenom = $_POST['prenom'];
		$nom = $_POST['nom']; 
		$email = $_POST['email'];
		$message = $_POST['message']; 


		$emailTo = "damir@romandie.com";
		$subject = "sujet";
		$emailFrom = $_POST['email']; 

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

		// envoi email 
		$success = mail($emailTo, $subject, $message, $headers);
		return $success;	

	}


}