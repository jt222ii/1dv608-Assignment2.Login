<?php
require_once('model/User.php');

class RegisterController {

	private $RegisterView;
	private $uDAL;
	private $user;

	private $unameInput;
	private $pwordInput;

	public function __construct(RegisterView $RegisterView, userDAL $uDAL){
		$this->RegisterView = $RegisterView;
		$this->uDAL = $uDAL;
	}
	
	public function userPost(){
		$this->unameInput = $this->RegisterView->getInputUname();
		$this->pwordInput = $this->RegisterView->getInputPword();

		if($this->RegisterView->hasUserTriedToRegister()){
			$this->user = new User($this->unameInput, $this->pwordInput);
			if($this->RegisterView->doesPasswordsMatch() && $this->RegisterView->wasValidInput())
			{
				$result = $this->uDAL->addUserToDatabase($this->user);
				$_SESSION['successfulRegistration'] = $result;
				$_SESSION['successfulRegistrationUsername'] = $this->RegisterView->getInputUname();
			}
		}	
	}
}