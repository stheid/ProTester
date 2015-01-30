<?php
require_once(realpath(dirname(__FILE__)) . '/settings.php');

class LoginController{	
$server = "127.0.0.1";
    $username = "root";
    $password = "";
    $database = "ProTester";
     
    $db_handle = mysql_connect($server, $username, $password);
    $db_found = mysql_select_db($database, $db_handle);
if ($db_found) {
echo 'Connected successfully';

session_start();
	public static function hasPermission($user, $password){
	 
	$query=mysqli_query("select from person where ID='".$_POST['username']."' and pwr='".$_POST['password']."'");
	if(mysqli_num_rows($query)==1){ 
echo 'Connected LOGN successfully';

} 
		return false;
	}

	public static function personHasTests(){
		return false;
	}


if (LoginController::hasPermission($_POST["usr"],$_POST["pwd"])){
	if (LoginController::personHasTests()) {
		$target=PATH."server/view/TestRunnerView.php";
	}else {
		$target=PATH."server/view/MainView.php";
	}
} else {
	$target=PATH."server/view/LoginView.php";
}
}
    die('Could not connect: ' . mysql_error());
mysql_close($db_found);

header("Location: $target");
}
?>