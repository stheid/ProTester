<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/Controller.php');

/**
 *
 * @author gamer01
 *        
 *         Handles Database Connections
 *        
 */
class DBController extends Controller {
	/**
	 * creates a new Database connection
	 *
	 * @return mysqli
	 */
	public static function getConnection() {
		parent::includes ();
		
		$mysqli = new mysqli ( DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
		
		/* check connection */
		if ($mysqli->connect_errno) {
			echo "Connect failed:  " . $mysqli->connect_error;
			exit ();
		}
		
		return $mysqli;
	}
}
?>