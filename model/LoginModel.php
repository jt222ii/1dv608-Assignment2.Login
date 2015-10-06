<?php
require_once('model/User.php');
class LoginModel {


	private $message;

	private static $user;

	public function __construct()
	{
		if(!isset($_SESSION['userLoggedIn']))
		{
			$_SESSION['userLoggedIn'] = false;
		}
	}

	public function attemptLogin($Uname, $Pword){

		$user = User::get($Uname);
		var_dump($user->comparePassword($Pword));
		if($user->comparePassword($Pword))		
		{			
			var_dump("heeej");
 			$_SESSION['userLoggedIn'] = true;		
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