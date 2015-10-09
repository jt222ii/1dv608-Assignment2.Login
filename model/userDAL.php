<?php

class userDAL {

	private $conn;
	private $userDAL;
	//ska tas bort o läggas i en ickepublik fil


	public function createConnection()
	{
		// Create connection
		$this->conn = mysqli_connect(Settings::$mysql_host, Settings::$mysql_user, Settings::$mysql_password, Settings::$mysql_database);
		// Check connection
		if ($this->conn->connect_error) {
		   die("Connection failed: " . $conn->connect_error);
		} 
		return $this->conn;
	}
	public function closeConnection()
	{
		mysqli_close($this->conn);
	}

	public function addUserToDatabase(User $user)
	{
		$username = $user->getUsername();
		$password = $user->getPassword();
		$connection = $this->createConnection();
		$sqlQuery = "INSERT INTO $this->mysql_database.`member` (`Username`, `Password`) VALUES ('$username', '$password')"; //Fick ha variabeln för databasnamnet i sql-satsen 
		$result = $connection->query($sqlQuery);																			//för att undvika problem om man döper databasen till samma namn som tabellen 

		$this->closeConnection();

		if (!$result)
		{
			return false;
		}
		return true;
	}

	public function getUserByUsername($username)
	{
		$connection = $this->createConnection();
		$sqlQuery = "SELECT Username, Password FROM member WHERE BINARY Username = '$username'";
		$result = $connection->query($sqlQuery);

		$data = $result->fetch_array(MYSQLI_ASSOC);

		$this->closeConnection();
		if($data == null || !isset($data))
		{
			return null;
		}
		$user = new User($data['Username'],$data['Password'],false);
		return $user;
	}

	public function userNameAlreadyExists($username)
	{
		$connection = $this->createConnection();
		$sqlQuery = "SELECT Username, Password FROM member WHERE Username = '$username'";
		$result = $connection->query($sqlQuery);
		if($result->num_rows == 0)
		{
			return false;
		}
		return true;
	}


}
