<?php

class ValidateCredentials{

	private $usernameValid;
	private $passwordValid;

	public function validateAll($username, $password)
	{
		$this->validateUsername($username);
		$this->validatePassword($password);

		if($this->isUserNameValid() && $this->isPasswordValid())
		{
			return true;
		}
		return false;
	}
	public function validateUsername($username)
	{
		if(mb_strlen($username)<3 || strip_tags($username) != $username)
		{
			$this->usernameValid = false;
		}	
		else
		$this->usernameValid = true;
	}
	public function validatePassword($password)
	{
		if(mb_strlen($password)<6)
		{
			$this->passwordValid = false;
		}	
		else
		$this->passwordValid = true;
	}

	public function isUserNameValid()
	{
		return $this->usernameValid;
	}

	public function isPasswordValid()
	{
		return $this->passwordValid;
	}

}