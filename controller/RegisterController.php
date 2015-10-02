<?php


class RegisterController {

	private $RegisterView;
	private $RegisterModel;
	public function __construct(RegisterView $RegisterView, RegisterModel $RegisterModel){
		$this->RegisterView = $RegisterView;
		$this->RegisterModel = $RegisterModel;
		//$this->RegisterModel->addUserToDatabase("Scrotum", "ledare");
	}

	//skicka in datan till modellen när man tröckt pö register

}