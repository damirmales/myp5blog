<?php
namespace Model;
/**** Cette classe permet de gérer la connexion à la base de données *****************/


	class Database	
	{   
		const DB_HOST = 'mysql:host=185.98.131.94;dbname=damir983633_2yn1hc;charset=utf8';
	    const DB_USER = 'damir983633';
	    const DB_PASS = 'sbjnhgvzqu';

				public function getConnectDB()
				{

					try
					{
						$connectPDO = new \PDO(self::DB_HOST, self::DB_USER , self::DB_PASS);
						$connectPDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
					
					// on renvoi un objet de type PDOstatement qui contien la connexion à la bdd
						return $connectPDO;
										
					}

					catch (Exception $e)
					{
						die('Erreur : ' . $e->getMessage());
					}					

				}
	}	


	


?>