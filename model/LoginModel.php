<?php

class LoginModel {

	private static $correctUname = 'Admin';
	private static $correctPword = 'password';
	private $unameInput;
	private $pwordInput;

	public function __construct(){

	}

	public function attemptLogin($Uname, $Pword){
		$this->unameInput = $Uname;
		$this->pwordInput = $Pword;

		if($this->unameInput == null && $this->pwordInput == null)
		{
			echo "tomma fält noob";
		}
		echo "test";

	}
	
}