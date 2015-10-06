<?php

class userDAL {

	private $conn;
	private $userDAL;
	//ska tas bort o läggas i en ickepublik fil


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
		$sqlQuery = "INSERT INTO `member`.`member` (`Username`, `Password`) VALUES ('$username', '$password')";
		$result = $connection->query($sqlQuery);
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
		$sqlQuery = "SELECT Username, Password FROM member WHERE BINARY Username = '$username'"; //Binary för av någon anledning skulle det vara case sensitive enligt testfallen
		$result = $connection->query($sqlQuery);

		$data = $result->fetch_array(MYSQLI_ASSOC);

		$this->closeConnection();
		return isset($data) ? array("Username" => $data['Username'], "Password" => $data['Password']) : null;
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
