<?php
namespace Model;
/****
 * Cette classe permet de gérer la connexion à la base de données 
 *****************/

class Database
{
    const DB_HOST = 'mysql:host=localhost;dbname=p5blog;charset=utf8';
    const DB_USER = 'root';
    const DB_PASS = '';

    public function getConnectDB()
    {
        try
        {
            $connectPDO = new \PDO(self::DB_HOST, self::DB_USER, self::DB_PASS);
            $connectPDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $connectPDO;
        }

        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }
}

