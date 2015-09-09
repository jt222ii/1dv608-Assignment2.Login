<?php

class LoginController {
//frågar model och skickar till view
	private $Uname;
	private $Pword;
	private $LoginView;

	public function __construct(LoginView $LoginView){
		$this->LoginView = $LoginView;
	}

	public function userPost(){
		if($this->LoginView->hasUserPosted()){
			echo "Användaren postade (LoginController line 15)";
			$this->getUname();
			$this->getPword();
		}	
	}

	public function getUname(){
		$this->LoginView->getInputUname();
	}

	public function getPword(){
		$this->LoginView->getInputPword();
	}


}