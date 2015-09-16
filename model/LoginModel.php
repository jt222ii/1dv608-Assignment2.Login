<?php

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
		if($this->unameInput === '')
		{		
			throw new Exception('Username is missing');		
		}			
		else if($this->unameInput !== '' && $this->pwordInput === '')		
		{		
			throw new Exception('Password is missing');		
		}		
		else if($this->unameInput !== self::$correctUname || $this->pwordInput !== self::$correctPword)		
 		{		 		
			throw new Exception('Wrong name or password');		
		}		
		else if($this->unameInput === self::$correctUname && $this->pwordInput === self::$correctPword)		
		{		
			if($_SESSION['userLoggedIn'])		
			{		
				throw new Exception();		
			}		
			else		
			{	
	 			$_SESSION['userLoggedIn'] = true;	
			}		
		}
	}
	public function logout(){
		if(!$_SESSION['userLoggedIn'])
		{
			throw new Exception();
		}
		else		
		{	
 			$_SESSION['userLoggedIn'] = false;			
		}	
	}
	public function isUserLoggedIn(){
		if($_SESSION['userLoggedIn'])
		{
			return $_SESSION['userLoggedIn'];
		}
		return false;
	}

}