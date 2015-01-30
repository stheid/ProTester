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
			Session::$loginError="You could not be logged in, Try again";
			$target=PATH."server/view/LoginView.php";
		}
		header("Location: $target");
	}
	
	public static function hasPermission($user, $password){
		return false;
	}

	public static function personHasTests(){
		return false;
	}
}
LoginController::main();
?>