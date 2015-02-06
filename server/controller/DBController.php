<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/Controller.php');
include_once 'settings.php';

class DBController extends Controller{
	
	public static function getConnection(){
		$mysqli = new mysqli (DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
		
		/* check connection */
		if ($mysqli->connect_errno) {
			echo "Connect failed:  " . $mysqli->connect_error;
			exit ();
		}
		
		return $mysqli;
	}
}
?>