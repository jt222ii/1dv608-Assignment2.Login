<?php
require_once('model/userDAL.php');
class User{

	private $username;
	private $password;
	private $saltfyfan = "mmsalt";

	private static $uDAL;

	public function __construct($username, $password, $dothehash = true)
	{
		$this->username = $username;
		$this->password = $dothehash ? $this->hash($password) : $password;
	}

	public function userNameAlreadyExists()
	{
		$result = self::$uDAL->userNameAlreadyExists($this->username);
		return $result;
	}
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
		return sha1($this->saltfyfan.$password.$this->username);
	}
	public function comparePassword($password)
	{
		if($this->password == $this->hash($password))
		{
			return true;
		}
		return false;
	}
	public function addToDatabase()
	{
		$result = self::$uDAL->addUserToDatabase($this);
		return $result;
	}
	public static function initialize()
	{
		self::$uDAL = new userDAL();
	}

	public static function get($username)
	{
		$data = self::$uDAL->getUserByUsername($username);

		$user = new User($data['Username'],$data['Password'],false);

		return $user;
	}
}
User::initialize();