<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/Controller.php');
class LogoutController extends Controller {
	public static function main() {
		parent::includes ();
		session_destroy();
		header ( "Location: ". PATH . "server/view/LoginView.php" );
	}
}
LogoutController::main ();

?>
