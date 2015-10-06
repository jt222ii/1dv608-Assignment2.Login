<?php

class User{

	private $username;
	private $password;

	public function __construct($username, $password)
	{
		$this->username = $username;
		$this->password = $this->hash($password);
	}

	public function getUsername()
	{
		return $this->username();
	}
	public function getPassword()
	{
		return $this->password();
	}
	public function hash($password)
	{
		return sha1($this->saltfyfan.$password);
	}
	public function comparePassword()
	{
		
	}

}