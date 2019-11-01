<?php
namespace Model;
use Model\Database;

class PdoConstruct extends Database{
	

		protected $connection;

		public function __construct(){

			$this->connection = $this->getConnectDB();
			
		}


}

?>