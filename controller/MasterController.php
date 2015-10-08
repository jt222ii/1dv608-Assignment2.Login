<?php
//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');
require_once('model/LoginModel.php');
require_once('model/validateCredentials.php');
require_once('model/userDAL.php');



class MasterController {
	//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
	/*error_reporting(E_ALL);
	ini_set('display_errors', 'On');*/

	//CREATE OBJECTS OF THE VIEWS

	// phpinfo();
	public function startApp(){

		$dtv = new DateTimeView();
		$lv = new LayoutView();
		$ud = new userDAL();
		$lm = new LoginModel($ud);
		if(isset($_GET['register']))
		{
			//$u = new User();
			$validate = new ValidateCredentials();
			$v = new RegisterView($validate);
			$rc = new RegisterController($v, $ud);
			$rc->userPost();
			if(isset($_SESSION['successfulRegistration']) && $_SESSION['successfulRegistration'] == true)
			{
				header("Location:http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
			}
		}
		else
		{
			$v = new LoginView($lm);
			$lc = new LoginController($v, $lm);
			$lc->userPost();
			
		}	
		$lv->render($lm->isUserLoggedIn(), $v, $dtv);
	}
	


}