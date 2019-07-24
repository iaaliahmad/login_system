<?php 


	/******************************************* 
	 		
	 		A class to link the database 

	 *******************************************/

class Dbconnection {
	
	

	private $hostname = "localhost"; // Server name
	private $username = "root";  // Server username
	private $password = "";  // Server Password
	private $db_name = "user_db";  // Database name

	protected $connection;

	public function __construct(){

		if(!isset($this->connection)){


			$this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->db_name);

			if(!$this->connection){

				// Check Database Connecetion

				echo "The database did not connect successfully";
				exit;
			} 
		}

		return $this->connection;
	}
	
}


 ?>


