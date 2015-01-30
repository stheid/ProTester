<?php
require_once(realpath(dirname(__FILE__)) . '/settings.php');

class LoginController{	
	public static function hasPermission($user, $password){
		return false;
	}

	public static function personHasTests(){
		return false;
	}
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
header("Location: $target");
?>