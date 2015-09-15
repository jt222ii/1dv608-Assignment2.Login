<?php
session_start();
class LoginModel {

	private static $correctUname = 'Admin';
	private static $correctPword = 'Password';
	private $unameInput;
	private $pwordInput;

	private $message;

	public function __construct()
	{
		if(!isset($_SESSION['userLoggedIn']))
		{
			$_SESSION['userLoggedIn'] = false;
		}
	}

	public function attemptLogin($Uname, $Pword){
		$this->unameInput = trim($Uname);
		$this->pwordInput = trim($Pword);

		if($this->unameInput === self::$correctUname && $this->pwordInput === self::$correctPword)
		{
			$_SESSION['userLoggedIn'] = true;
		}
		else
		{
			$_SESSION['userLoggedIn'] = false;
		}
	}
	public function logout(){
		$_SESSION['userLoggedIn'] = false;
	}
	public function isUserLoggedIn(){
		if($_SESSION['userLoggedIn'])
		{
			return $_SESSION['userLoggedIn'];
		}
		return false;
	}

}