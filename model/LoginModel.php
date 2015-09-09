<?php

class LoginModel {

	private static $correctUname = 'Admin';
	private static $correctPword = 'password';
	private $unameInput;
	private $pwordInput;

	private $message;
	private $logInStatus;

	public function attemptLogin($Uname, $Pword){
		$this->logInStatus = false;
		$this->unameInput = trim($Uname);
		$this->pwordInput = trim($Pword);

		if($this->unameInput === '' && $this->pwordInput === '')
		{
			$this->message = "Username is missing";
		}	
		else if($this->unameInput !== '' && $this->pwordInput === '')
		{
			$this->message = "Password is missing";
		}
		else if($this->unameInput === '' && $this->pwordInput !== '')
		{
			$this->message = "Username is missing";
		}
		else if($this->unameInput === self::$correctUname && $this->pwordInput !== self::$correctPword)
		{
			$this->message = "Wrong name or password";
		}
		else if($this->unameInput !== self::$correctUname && $this->pwordInput === self::$correctPword)
		{
			$this->message = "Wrong name or password";
		}
		else if($this->unameInput === self::$correctUname && $this->pwordInput === self::$correctPword)
		{
			$this->message = "Welcome";
			$this->logInStatus = true;
		}
	}
	
	public function getMessage(){
		return $this->message;
	}
	public function getLoginStatus(){
		return $this->logInStatus;
	}

}