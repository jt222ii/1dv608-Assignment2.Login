<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	private static $register = 'LoginView::Register';
	private static $regRepeatPassword = 'LoginView::RegisterRepeatPassword';

	private static $keepName = '';
	
	private $message;
	private $LoginModel;



	public function __construct(LoginModel $loginModel){
		$this->LoginModel = $loginModel;
		if(!isset($_SESSION['messageBool']))
		{
			$_SESSION['messageBool'] = true;
		}	
	}

	public function hasUserTriedToLogin(){
		if(isset($_POST[self::$login]))
		{
			return true;
		}
	}

	public function hasUserTriedToRegister(){
		if(isset($_POST[self::$register]))
		{
			return true;
		}
	}

	public function setMessage(){
		$this->message = '';
		if($this->hasUserTriedToLogin())
		{
			if($this->getInputUname() == '')
			{
				$this->message = 'Username is missing';
			}	
			else if($this->getInputUname() != '' && $this->getInputPword() == '')
			{
				$this->message = 'Password is missing';
			}
			else if(!$this->LoginModel->isUserLoggedIn())
			{
				$this->message = 'Wrong name or password';
			}
			else if($this->LoginModel->isUserLoggedIn() && $_SESSION['messageBool'])
			{
				$_SESSION['messageBool'] = false;
				$this->message = 'Welcome';
			}
		}
		
		if($this->hasUserTriedToRegister())
		{
			$this->message = "";
			if(mb_strlen($this->getInputUname())<3)
			{
				$this->message .= 'Username has too few characters, at least 3 characters.</br>';
			}	
			if(mb_strlen($this->getInputPword())<6)
			{
				$this->message .= 'Password has too few characters, at least 6 characters.</br>';
			}	
			if($this->getInputPword() != $this->getInputRepeatPword())
			{
				$this->message .= 'Passwords do not match.</br>';
			}
		}
		else if ($this->userLogout() && !$_SESSION['messageBool'])
		{
			$_SESSION['messageBool'] = true;
			$this->message = 'Bye bye!';
			session_destroy();
		}
 	}		 	

	public function userLogout(){
		if(isset($_POST[self::$logout]))
		{
			return true;
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
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$response = "";
		$this->setMessage();
		if(isset($_GET['register']) )
		{
			$response = $this->generateRegisterFormHTML($this->message);
		}
		else if($this->LoginModel->isUserLoggedIn())
		{
			$response .= $this->generateLogoutButtonHTML($this->message);
		}
		else
		{
			self::$keepName = $this->getInputUname();
			$response .= $this->generateLoginFormHTML($this->message);
		}


		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	private function generateRegisterLinkHTML() {
		if(isset($_GET['register']))
		{
			return '<a href=?>GO BACK!</a>';
		}
		else
		return '<a href=?register>REGISTER NOW!</a>';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<p>'.$this->generateRegisterLinkHTML().'</p>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . self::$keepName .'" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
	}

	private function generateRegisterFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<p>'.$this->generateRegisterLinkHTML().'</p>
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



	
}