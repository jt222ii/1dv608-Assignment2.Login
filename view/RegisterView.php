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
	private $wasValidCredentials;

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
			$this->validateInput();
			self::$keepName = $this->getInputUname();
			return true;
		}
	}
	public function validateInput()
	{
		$this->wasValidCredentials = $this->ValidateCredentials->validateAll($this->getInputUname(), $this->getInputPword());
	}
	public function wasValidInput()
	{
		return $this->wasValidCredentials;
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
			if(isset($_SESSION['successfulRegistration']) && !$_SESSION['successfulRegistration']) // går nog lösas utan session TODO: asd
			{
				$this->message .= "User exists, pick another username.<br />";
				unset($_SESSION['successfulRegistration']);
			}
			if(!$this->ValidateCredentials->isUserNameValid())
			{
				if(preg_match("/^[A-Za-z0-9]+$/", $this->getInputUname()) == 0)
				{
					$this->message .= 'Username contains invalid characters.<br />';
					self::$keepName = strip_tags($this->getInputUname());
				}
				else
				$this->message .= 'Username has too few characters, at least 3 characters.<br />';
			}	
			if(!$this->ValidateCredentials->isPasswordValid())
			{
				$this->message .= 'Password has too few characters, at least 6 characters.<br />';
			}	
			if(!$this->doesPasswordsMatch())
			{
				$this->message .= 'Passwords do not match.<br />';
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