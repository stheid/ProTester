<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/Controller.php');

/**
 *
 * @author gamer01
 *         Manages redirections and the login process
 */
class LoginController extends Controller {
	
	/**
	 */
	public function __construct() {
		parent::includes ();
		include_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Person.php');
		
		if (isset ( $_SESSION ['ID'] )) {
			$this->cleanupSession ();
			
			$person = new Person ( $_SESSION ['ID'] );
			if ($person->hasUnansweredTestsToday ()) {
				$target = PATH . "server/view/TestRunnerView.php";
			} else {
				$target = PATH . "server/view/MainView.php";
			}
		} else {
			// Select queries return a resultset
			if (Person::hasPermission ( $_POST ["usr"], $_POST ["pwd"] )) {
				$person = new Person ( $_SESSION ['ID'] );
				if ($person->hasUnansweredTestsToday ()) {
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
	
	/**
	 * Deletes unused Session Fields
	 */
	private function cleanupSession() {
		unset ( $_SESSION ['TestID'] );
		unset ( $_SESSION ['TestTemplateID'] );
		unset ( $_SESSION ['disableNav'] );
		unset ( $_SESSION ['index'] );
	}
}
new LoginController ();
?>