<?php
require_once('model/User.php');
class RegisterController {

	private $RegisterView;
	private $user;
	private $result;

	public function __construct(RegisterView $RegisterView){
		$this->RegisterView = $RegisterView;
		
	}
	//skicka in datan till modellen när man tröckt pö register
	public function userPost(){
		if($this->RegisterView->hasUserTriedToRegister() && $this->RegisterView->doesPasswordsMatch()){
			$this->user = new User($this->RegisterView->getInputUname(), $this->RegisterView->getInputPword());
			$this->result = $this->user->addToDatabase();
			$_SESSION['successful'] = $this->result;
		}	
	}
}