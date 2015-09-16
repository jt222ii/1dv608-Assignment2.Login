<?php
session_start();
//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('controller/LoginController.php');
require_once('model/LoginModel.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/

//CREATE OBJECTS OF THE VIEWS

$dtv = new DateTimeView();
$lv = new LayoutView();

$lm = new LoginModel();
$v = new LoginView($lm);

$lc = new LoginController($v, $lm);


$lc->userPost();


$lv->render($lm->isUserLoggedIn(), $v, $dtv);

