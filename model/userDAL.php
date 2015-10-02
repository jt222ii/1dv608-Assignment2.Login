<?php

class userDAL {

	private $conn;
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

}
