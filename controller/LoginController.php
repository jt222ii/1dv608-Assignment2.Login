<?php

class LoginController {
//frågar model och skickar till view
	private $Uname;
	private $Pword;
	private $LoginView;
	private $LoginModel;

	public function __construct(LoginView $LoginView, LoginModel $LoginModel){
		$this->LoginView = $LoginView;
		$this->LoginModel = $LoginModel;
	}

	public function userPost(){
		if($this->LoginView->hasUserPosted()){
			//echo "Användaren postade (LoginController line 15)";
			$this->setUname();
			$this->setPword();
			var_dump($this->Uname);
			$this->LoginModel->attemptLogin($this->Uname, $this->Pword);
		}	
	}

	public function setUname(){
		$this->Uname = $this->LoginView->getInputUname();
	}

	public function setPword(){
		$this->Pword = $this->LoginView->getInputPword();
	}


}