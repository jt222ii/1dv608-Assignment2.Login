<?php

class userDAL {

	private $conn;
	private $username;
	private $password;
	private $userDAL;
	//ska tas bort o läggas i en ickepublik fil
	private $saltfyfan = "mmsalt";

	public function createConnection()
	{
		$mysql_host = "localhost";
		$mysql_user = "jt222ii";
		$mysql_password = "jt222ii";
		$mysql_database = "member";

		// Create connection
		$this->conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);
		// Check connection
		if ($this->conn->connect_error) {
		   die("Connection failed: " . $conn->connect_error);
		} 
		echo "Connected successfully";
		return $this->conn;
	}
	public function closeConnection()
	{
		mysqli_close($this->conn);
	}

	public function addUserToDatabase($username, $password)
	{
		$connection = $this->createConnection();
		$this->username = $username;
		$this->password = $this->hash($password);
		$sqlQuery = "INSERT INTO `member`.`member` (`Username`, `Password`) VALUES ('$this->username', '$this->password')";
		$result = $connection->query($sqlQuery);
		
		if (!$result)
		{
			echo "Upptaget användarnamn";
		}

		$this->closeConnection();
	}

	public function getUserByUsername($username)
	{
		//$sqlQuery = "SELECT `member`.`member` (`Username`, `Password`) VALUES ('$this->username', '$this->password')";
	}


}
