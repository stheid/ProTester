<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/Controller.php');

/**
 *
 * @author gamer01
 *         destroyes the session and redirects to login
 */
class LogoutController extends Controller {
	public function __construct() {
		parent::includes ();
		session_destroy ();
		header ( "Location: " . PATH . "server/view/LoginView.php" );
	}
}
new LogoutController ();
?>
