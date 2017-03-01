<?php

class Database
{
    //defining the database connection variables
    private $host = "localhost";
    private $db_name = "phptest";
    private $username = "root";
    private $password = "3rdNovember@2013";
    
    public $conn;
     
    //database connection function
    public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}
?>