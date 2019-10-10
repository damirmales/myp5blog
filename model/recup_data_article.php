		<?php
		require_once('Database.php');
		$db=new Database();
		$connexionPDO=$db->getConnectDB();


	//-------------------- on vérifie si les valeurs requises sont présentes -------------
		if (!empty(!empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['rubrique'])))
		{
			echo 'hello '.$_POST['titre'].'</br>';
			echo $_POST['contenu'].'</br>';
			echo $_POST['rubrique'].'</br>';


			try
			{
				
				$newArticle = $connexionPDO->prepare('INSERT INTO articles VALUES("", :titre, :chapo, :auteur, :contenu,:rubrique, NOW(),NOW())');
				$newArticle->BindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
				$newArticle->BindValue(':chapo', $_POST['chapo'], PDO::PARAM_STR);
				$newArticle->BindValue(':auteur', $_POST['auteur'], PDO::PARAM_STR);
				$newArticle->BindValue(':contenu', $_POST['contenu'], PDO::PARAM_STR);
				$newArticle->BindValue(':rubrique', $_POST['rubrique'], PDO::PARAM_STR);
				
				
				$affectedLines = $newArticle->execute();
			}
			catch (Exception $e)
			{
				die('Erreur : ' . $e->getMessage());
			}

			echo var_dump($connexionPDO);
			return $affectedLines;

		}
		else
		{
			echo'il manque un renseignement';
		}
	//----------------------------

		?> 


