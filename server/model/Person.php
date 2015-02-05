<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/../controller/DBController.php');
require_once (realpath ( dirname ( __FILE__ ) ) . '/Test.php');
// require_once(realpath(dirname(__FILE__)) . '/Course.php');

/**
 *
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Person {
	/**
	 * @AttributeType int
	 */
	private $_iD;
	/**
	 * @AttributeType String
	 */
	private $_name;
	/**
	 * @AttributeType String
	 */
	private $_surname;
	/**
	 * @AssociationType Server.Model.Person
	 */
	public $_unnamed_Person_;
	/**
	 * @AssociationType Server.Model.Test
	 * @AssociationMultiplicity 1
	 */
	public $_tests = array ();
	/**
	 * @AssociationType Server.Model.Course
	 * @AssociationMultiplicity *
	 */
	public $_courses = array ();
	public static function hasPermission($user, $password, $mysqli) {
		$exitcode = false;
		
		if (empty ( $user ) || empty ( $password )) {
			$_SESSION ['loginError'] = "Password or Username was empty. Please provide in all information";
		} else {
			if ($result = $mysqli->query ( "SELECT id,name,discriminator FROM person WHERE id='" . $user . "' AND pwd='" . $password . "';" )) {
				if ($result->num_rows == 0) {
					$_SESSION ['loginError'] = "Username or Password wrong.";
				} else {
					$row = $result->fetch_array ( MYSQLI_ASSOC );
					$_SESSION ['id'] = $row ['id'];
					$_SESSION ['username'] = $row ['name'];
					if (strpos ( $row ['discriminator'], "Student" ) !== false) {
						$_SESSION ['isStudent'] = true;
					}
					if (strpos ( $row ['discriminator'], "Lecturer" ) !== false) {
						$_SESSION ['isLecturer'] = true;
					}
					if (strpos ( $row ['discriminator'], "Admin" ) !== false) {
						$_SESSION ['isAdmin'] = true;
					}
					
					$exitcode = true;
				}
				
				// free result set
				$result->close ();
			} else {
				$_SESSION ['loginError'] = "Error with Database :/";
			}
		}
		
		return $exitcode;
	}
	public static function personHasTests() {
		return false;
	}
	
	/**
	 * returns a testarray to create ViewTestTab
	 */
	public static function getWritlenTests($personid) {
		// find all tests for this person
		$mysqli = DBController::getConnection ();
		
		$result = $mysqli->query ( "SELECT id FROM test,testtemplate WHERE PersonID=" . $personid . " ORDER BY date" );
		// delegate the test class to create test objects according testid (call the constructor in a loop)
		$tests = array ();
		while ( $row = $result->fetch_array ( MYSQLI_ASSOC ) ) {
			array_push ( $tests, new Test ( $row ['id'] ) );
		}
		// return this array of objects
		
		return $tests;
	}
}
?>