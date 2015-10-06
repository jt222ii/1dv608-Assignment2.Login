<?php
require_once('model/User.php');

class RegisterController {

	private $RegisterView;
	private $ValidateCredentials;
	private $passedValidation;
	private $user;

	private $unameInput;
	private $pwordInput;

	public function __construct(RegisterView $RegisterView, ValidateCredentials $ValidateCredentials){
		$this->RegisterView = $RegisterView;
		$this->ValidateCredentials = $ValidateCredentials;
	}
	
	public function userPost(){
		$this->unameInput = $this->RegisterView->getInputUname();
		$this->pwordInput = $this->RegisterView->getInputPword();

		$this->passedValidation = $this->ValidateCredentials->validateAll($this->unameInput, $this->pwordInput); //godkänt? fråga

		$this->user = new User($this->unameInput, $this->pwordInput);

		if($this->RegisterView->hasUserTriedToRegister()){
			if($this->user->userNameAlreadyExists())
			{
				$_SESSION['successful'] = false;
			}
			else if($this->RegisterView->doesPasswordsMatch() && $this->passedValidation)
			{
				$result = $this->user->addToDatabase();
				$_SESSION['successful'] = $result;
			}
		}	
	}
}