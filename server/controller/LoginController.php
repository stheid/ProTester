<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/Controller.php');
require_once (realpath ( dirname ( __FILE__ ) ) . '/DBController.php');
class LoginController extends Controller {
	public static function main() {
		parent::includes ();
		include_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Person.php');
		
		if (isset ( $_SESSION ['id'] )) {
			if (Person::personHasTests ()) {
				$target = PATH . "server/view/TestRunnerView.php";
			} else {
				$target = PATH . "server/view/MainView.php";
			}
		} else {
			// Select queries return a resultset
			if (Person::hasPermission ( $_POST ["usr"], $_POST ["pwd"], DBController::getConnection() )) {
				if (Person::personHasTests ()) {
					$target = PATH . "server/view/TestRunnerView.php";
				} else {
					$target = PATH . "server/view/MainView.php";
				}
			} else {
				
				$target = PATH . "server/view/LoginView.php";
			}
		}
		header ( "Location: $target" );
	}
}
LoginController::main();
?>