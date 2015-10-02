<?php

class RegisterModel {

	private $conn;
	private $username;
	private $password;
	private $userDAL;

	//ska tas bort o läggas i en ickepublik fil
	private $saltfyfan = "mmsalt";

	public function __construct($userDAL)
	{
		$this->userDAL = $userDAL;
	}
	public function addUserToDatabase($username, $password)
	{
			$connection = $this->userDAL->createConnection();
			$this->username = $username;
			$this->password = $this->hash($password);
			$sqlQuery = "INSERT INTO `member`.`member` (`Username`, `Password`) VALUES ('$this->username', '$this->password')";
			$result = $connection->query($sqlQuery);

			if (!$result)
			{
				echo "Upptaget användarnamn";
			}

			$this->userDAL->closeConnection();
	}

	public function hash($password)
	{
		return sha1($this->saltfyfan.$password);
	}
}