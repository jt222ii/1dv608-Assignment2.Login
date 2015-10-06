<?php


class RegisterController {

	private $RegisterView;
	private $userDAL;
	private $result;
	public function __construct(RegisterView $RegisterView, UserDAL $userDAL){
		$this->RegisterView = $RegisterView;
		$this->userDAL = $userDAL;
	}

	//skicka in datan till modellen när man tröckt pö register
	public function userPost(){
		if($this->RegisterView->hasUserTriedToRegister() && $this->RegisterView->doesPasswordsMatch()){
			$this->userDAL->addUserToDatabase($this->RegisterView->getInputUname(), $this->RegisterView->getInputPword());
		}	
	}
}