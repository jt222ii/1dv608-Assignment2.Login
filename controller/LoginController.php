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
			//hämtar input och försöker logga in
			try{
				$this->LoginModel->attemptLogin($this->LoginView->getInputUname(), $this->LoginView->getInputPword());	
				$this->LoginView->setWelcomeMessage();
			}
			catch(Exception $e){
				$this->LoginView->setMessage($e->getMessage());
			}
		}	
		else if ($this->LoginView->userLogout())
		{
			try{
				$this->LoginModel->logout();	
				$this->LoginView->setLogoutMessage();
			}
			catch(Exception $e){
				$this->LoginView->setMessage($e->getMessage());
			}
		}
	}
}