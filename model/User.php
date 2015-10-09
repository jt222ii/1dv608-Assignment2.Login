<?php
require_once('model/userDAL.php');
class User{

	private $username;
	private $password;

	//private static $uDAL;

	public function __construct($username, $password, $dohash = true)
	{
		$this->username = $username;
		$this->password = $dohash ? $this->hash($password) : $password;
	}

	// public function userNameAlreadyExists()
	// {
	// 	$result = self::$uDAL->userNameAlreadyExists($this->username);
	// 	return $result;
	// }
	public function getUsername()
	{
		return $this->username;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function hash($password)
	{
		return sha1(Settings::$salt.$password.$this->username);
	}
	public function comparePassword($password)
	{
		if($this->password == $this->hash($password))
		{
			return true;
		}
		return false;
	}
	// public function addToDatabase()
	// {
	// 	$result = self::$uDAL->addUserToDatabase($this);
	// 	return $result;
	// }
}