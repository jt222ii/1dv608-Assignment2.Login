<?php


class RegisterView {
	private static $name = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
	private static $messageId = 'RegisterView::Message';

	private static $register = 'RegisterView::Register';
	private static $regRepeatPassword = 'RegisterView::PasswordRepeat';

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
			self::$keepName = $this->getInputUname();
			return true;
		}
	}

	private function generateRegisterFormHTML($message) {
		return '
			<h2>Register new user</h2>
			<form method="post" > 
				<fieldset>
					<p id="' . self::$messageId . '">' . $message .'</p>
					<legend>Register - enter Username and password</legend>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'. self::$keepName .'"/>

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$regRepeatPassword . '">Repeat Password :</label>
					<input type="password" id="' . self::$regRepeatPassword . '" name="' . self::$regRepeatPassword . '" />
					
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
				$this->message .= "User exists, pick another username.";
				unset($_SESSION['successful']);
			}
			if(!$this->ValidateCredentials->isUserNameValid())
			{
				if(strip_tags($this->getInputUname()) != $this->getInputUname())
				{
					$this->message .= 'Username contains invalid characters.';
					self::$keepName = strip_tags($this->getInputUname());
				}
				else
				$this->message .= 'Username has too few characters, at least 3 characters.';
			}	
			if(!$this->ValidateCredentials->isPasswordValid())
			{
				$this->message .= 'Password has too few characters, at least 6 characters.';
			}	
			if(!$this->doesPasswordsMatch())
			{
				$this->message .= 'Passwords do not match.';
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