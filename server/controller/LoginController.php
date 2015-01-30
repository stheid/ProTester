<?php
require_once(realpath(dirname(__FILE__)) . '/Controller.php');


class LoginController extends Controller {	
	public static function main(){
		parent::includes();
		
		if (static::hasPermission($_POST["usr"],$_POST["pwd"])){
			if (static::personHasTests()) {
				$target=PATH."server/view/TestRunnerView.php";
			}else {
				$target=PATH."server/view/MainView.php";
			}
		} else {
			$target=PATH."server/view/LoginView.php";
		}
		header("Location: $target");
	}
	
	public static function hasPermission($user, $password){
		if (empty($user)&&empty($password)){
			$_SESSION['loginError']="Password or Username was empty. Please provide in all information";
		}
		return false;
	}

	public static function personHasTests(){
		return false;
	}
}
session_start();
LoginController::main();
?>