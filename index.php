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
//phpinfo();
// $servername = "mysql8.000webhost.com";
// $username = "a2268719_jt222ii";
// $password = "jt222ii";
// $dbname = "a2268719_reg";

$servername = "localhost";
$username = "jt222ii";
$password = "jt222ii";
$dbname = "member";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
mysqli_close($conn);

$dtv = new DateTimeView();
$lv = new LayoutView();

$lm = new LoginModel();
$v = new LoginView($lm);

$lc = new LoginController($v, $lm);


$lc->userPost();


$lv->render($lm->isUserLoggedIn(), $v, $dtv);

