<?php
require_once('model/User.php');
class RegisterController {

	private $RegisterView;
	private $user;

	public function __construct(RegisterView $RegisterView){
		$this->RegisterView = $RegisterView;
	}
	//skicka in datan till modellen när man tröckt pö register
	public function userPost(){

		$this->user = new User($this->RegisterView->getInputUname(), $this->RegisterView->getInputPword());
		if($this->RegisterView->hasUserTriedToRegister()){
			if($this->user->userNameAlreadyExists())
			{
				$_SESSION['successful'] = false;
			}
			else if($this->RegisterView->doesPasswordsMatch())
			{
				$result = $this->user->addToDatabase();
				$_SESSION['successful'] = $result;
			}
		}	
	}
}