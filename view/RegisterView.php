<?php

class RegisterView {
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $messageId = 'LoginView::Message';

	private static $register = 'LoginView::Register';
	private static $regRepeatPassword = 'LoginView::RegisterRepeatPassword';

	private static $keepName = '';
	
	private $message;

	private $ValidateCredentials;


	public function __construct(ValidateCredentials $ValidateCredentials){
		$this->ValidateCredentials = $ValidateCredentials;
	}
	public function response() {
		$response = "";
		$this->setMessage();
		$response = $this->generateRegisterFormHTML($this->message);
		return $response;
	}
	public function hasUserTriedToRegister(){
		if(isset($_POST[self::$register]))
		{
			return true;
		}
	}

	private function generateRegisterFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<p id="' . self::$messageId . '">' . $message .'</p>
					<legend>Register - enter Username and password</legend>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" /></br>

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" /></br>

					<label for="' . self::$regRepeatPassword . '">Repeat Password :</label>
					<input type="password" id="' . self::$regRepeatPassword . '" name="' . self::$regRepeatPassword . '" /></br>
					
					<input type="submit" name="' . self::$register . '" value="register" />
				</fieldset>
			</form>
		';
	}

	public function setMessage(){
		$this->message = '';
		if($this->hasUserTriedToRegister())
		{
			if(isset($_SESSION['successful']) && !$_SESSION['successful']) // går nog lösas utan session TODO: asd
			{
				$this->message .= "User exists, pick another username.</br>";
				unset($_SESSION['successful']);
			}
			if(!$this->ValidateCredentials->isUserNameValid())
			{
				$this->message .= 'Username has too few characters, at least 3 characters.</br>';
			}	
			if(!$this->ValidateCredentials->isPasswordValid())
			{
				$this->message .= 'Password has too few characters, at least 6 characters.</br>';
			}	
			if(!$this->doesPasswordsMatch())
			{
				$this->message .= 'Passwords do not match.</br>';
			}
		}
 	}

	public function getInputUname(){
		if(isset($_POST[self::$name]))
		{
			return $_POST[self::$name];
		}
	}

	public function getInputPword(){
		if(isset($_POST[self::$password]))
		{
			return $_POST[self::$password];
		}
	}
	
	public function getInputRepeatPword(){
		if(isset($_POST[self::$regRepeatPassword]))
		{
			return $_POST[self::$regRepeatPassword];
		}
	}	

	public function doesPasswordsMatch()
	{
		if($this->getInputPword() != $this->getInputRepeatPword())
		{
			return false;
		}
		return true;
	}

	public function setRegistrationStatus($status)
	{
		$this->successfulregistration = $status;
	}

 }