<?php
namespace Model\backend;

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

		// envoi email 
		$success = mail($emailTo, $subject, $message, "From: <$emailFrom>");
		return $success;	

	}


}