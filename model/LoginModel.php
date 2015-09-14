<?php
session_start();
class LoginModel {

	private static $correctUname = 'Admin';
	private static $correctPword = 'Password';
	private $unameInput;
	private $pwordInput;

	private $message;
	private $logInStatus;

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

		if($this->unameInput === '')
		{
			$this->message = 'Username is missing';
		}	
		else if($this->unameInput !== '' && $this->pwordInput === '')
		{
			$this->message = 'Password is missing';
		}
		else if($this->unameInput !== self::$correctUname || $this->pwordInput !== self::$correctPword)
		{
			$this->message = 'Wrong name or password';
		}
		else if($this->unameInput === self::$correctUname && $this->pwordInput === self::$correctPword)
		{
			if($_SESSION['userLoggedIn'])
			{
				$this->message = '';
			}
			else
			{
				$this->message = 'Welcome';
			}
			$_SESSION['userLoggedIn'] = true;
		}
		return false;
	}
	public function logoutMessage(){
		if($_SESSION['userLoggedIn'] === false)
		{
			$this->message = '';
		}
		else
		{
			$this->message = 'Bye bye!';
		}
		$_SESSION['userLoggedIn'] = false;
		session_destroy();	
	}
	
	public function getMessage(){
		return $this->message;
	}
	public function isUserLoggedIn(){
		if(isset($_SESSION['userLoggedIn']))
		{
			if($_SESSION['userLoggedIn'])
			{
				return $_SESSION['userLoggedIn'];
			}
			return false;	
		}
	}

}