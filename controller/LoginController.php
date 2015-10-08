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

		if ($this->LoginView->userTriedToLogout() && $this->LoginModel->isUserLoggedIn())
		{
			$this->LoginView->setUserJustLoggedOut();
			$this->LoginModel->logout();	
		}
		else if($this->LoginView->hasUserTriedToLogin() && !$this->LoginModel->isUserLoggedIn()){
			$this->LoginView->setUserJustLoggedIn();
			$this->LoginModel->attemptLogin($this->LoginView->getInputUname(), $this->LoginView->getInputPword());
		}	
	}
}