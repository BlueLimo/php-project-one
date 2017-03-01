<?php

require_once 'dbconfig.php';

class USER
{
	private $conn;
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}

	//function for the registration of the users
	public function register($fname,$lname,$email,$phone,$pass,$code)
	{
		try
		{
			$password = md5($pass);
			$stmt = $this->conn->prepare("INSERT INTO users_table(fname,lname,email,phone,password,tokenCode) VALUES(:fname, :lname, :email, :phone, :password, :tokenCode)");
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":phone",$phone);
			$stmt->bindparam(":password",$password);
			$stmt->bindparam(":tokenCode",$code);

			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	//function for user login
	public function login($email,$pass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users_table WHERE email=:email");
			$stmt->execute(array(":email"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y" || $userRow['userStatus']=="N")
				{
					if($userRow['password']==md5($pass))
					{
						$_SESSION['userSession'] = $userRow['userID'];
						return true;
					}
					else
					{
						header("Location: index.php?error");
						exit;
					}
				}
				else
				{
					header("Location: index.php?inactive");
					exit;
				}
			}
			else
			{
				header("Location: index.php?error");
				exit;
			}
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}


	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}

	public function redirect($url)
	{
		header("Location: $url");
	}

	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
}

