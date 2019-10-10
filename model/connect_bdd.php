<?php


function connexionPDO(){
	try
	{
	$connexionPDO = new PDO('mysql:host=localhost;dbname=p5blog;charset=utf8', 'root', '');
	$connexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//$resultats = $connexionPDO->query('SELECT titre FROM articles ORDER BY titre DESC');
	}
	catch (Exception $e)
	{
			die('Erreur : ' . $e->getMessage());
	}

	return $connexionPDO;


}
?>






