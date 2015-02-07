<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/Controller.php');
require_once (realpath ( dirname ( __FILE__ ) ) . '/DBController.php');
class LoginController extends Controller {
	public static function main() {
		parent::includes ();
		include_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Person.php');
				
		if (isset ( $_SESSION ['id'] )) {
			$person=new Person($_SESSION['id']);
			if ($person->hasTestsToday ()) {
				$target = PATH . "server/view/TestRunnerView.php";
			} else {
				$target = PATH . "server/view/MainView.php";
			}
		} else {
			// Select queries return a resultset
			if (Person::hasPermission ( $_POST ["usr"], $_POST ["pwd"])) {
				$person=new Person($_SESSION['id']);
				if ($person->hasTestsToday  ()) {
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