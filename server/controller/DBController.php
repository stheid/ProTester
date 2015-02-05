<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/Controller.php');

class DBcontroller extends controller{
	
	public function getConnection(){

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