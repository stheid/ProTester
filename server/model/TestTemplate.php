<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/Course.php');
require_once (realpath ( dirname ( __FILE__ ) ) . '/Question.php');

/**
 *
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class TestTemplate {
	/**
	 * @AttributeType int
	 */
	private $_testTemplateID;
	/**
	 * @AttributeType int
	 */
	private $_duration;
	/**
	 * @AttributeType Date
	 */
	private $_date;
	/**
	 * @AssociationType Server.Model.Course
	 * @AssociationMultiplicity 0..1
	 */
	public $_course;
	public function __construct($id) {
		$mysqli = DBController::getConnection ();
		
		$query = 'SELECT * FROM TestTemplate WHERE TestTemplateID="' . $id . '";';
		if ($result = $mysqli->query ( $query )) {
			
			$row = $result->fetch_array ( MYSQLI_ASSOC );
			$this->_testTemplateID = $row ['TestTemplateID'];
			$this->_course = new Course ( $row ['CourseID'], $row ['GroupID'] );
			$this->_duration = $row ['Duration'];
			$this->_date = $row ['Date'];
		} else {
			echo "<script>console.log(\"" . __CLASS__ . "->" . __METHOD__ . " failed DB response\")</script>";
		}
		
		$result->free ();
		$mysqli->close ();
	}
	
	/**
	 *
	 * @return @see Question Array for this Template
	 */
	public function getQuestions() {
		$mysqli = DBController::getConnection ();
		$query = 'SELECT QuestionID FROM Question	WHERE TestTemplateID="' . $this->_testTemplateID . '" ORDER BY QuestionID';
		
		$questions = array ();
		if ($result = $mysqli->query ( $query )) {
			while ( $row = $result->fetch_array ( MYSQLI_ASSOC ) ) {
				array_push ( $questions, Question::getQuestion ( $row ['QuestionID'] ) );
			}
			$result->free ();
		} else {
			echo "<script>console.log(\"" . __CLASS__ . "->" . __METHOD__ . " failed DB response\")</script>";
		}
		$mysqli->close ();
		
		return $questions;
	}
	
	/**
	 *
	 * @return @see Test Array for this Template
	 */
	public function getTests() {
		$mysqli = DBController::getConnection ();
		$query = 'SELECT TestID FROM Test WHERE TestTemplateID="' . $this->_testTemplateID . '" ORDER BY TestID';
		
		$tests = array ();
		if ($result = $mysqli->query ( $query )) {
			while ( $row = $result->fetch_array ( MYSQLI_ASSOC ) ) {
				array_push ( $tests, new Test ( $row ['TestID'] ) );
			}
			$result->free ();
		} else {
			echo "<script>console.log(\"" . __CLASS__ . "->" . __METHOD__ . " failed DB response\")</script>";
		}
		$mysqli->close ();
		
		return $tests;
	}
	
	/**
	 *
	 * @param        	
	 *
	 * @see Person $person
	 * @return @see Test|NULL
	 */
	public function getTest($person) {
		foreach ( $this->getTests () as $test ) {
			if ($test->ownedBy ( $person )) {
				return $test;
			}
		}
		return NULL;
	}
	
	/**
	 *
	 * checks if given person has answered this template
	 *
	 * @param        	
	 *
	 * @see Person $person
	 * @return boolean
	 */
	public function isAnsweredFrom($person) {
		$exitcode = false;
		foreach ( $this->getTests () as $test ) {
			if ($test->ownedBy ( $person )) {
				$exitcode = true;
			}
		}
		return $exitcode;
	}
	
	/**
	 * checks if all tests of this template are already evaluated
	 *
	 * @return boolean
	 */
	public function isEvaluated() {
		foreach ( $this->getTests () as $test ) {
			if (! $test->isEvaluated ()) {
				return FALSE;
			}
		}
		return TRUE;
	}
	
	/**
	 * Checks if given person can answer this test
	 *
	 * @param        	
	 *
	 * @see Person $person
	 * @return boolean
	 */
	public function answerableFor($person) {
		$mysqli = DBController::getConnection ();
		
		$result = $mysqli->query ( 'SELECT PersonID FROM Person_Course as p JOIN TestTemplate as t
				ON p.CourseID=t.CourseID AND p.GroupID=t.GroupID
				WHERE TestTemplateID="' . $this->_testTemplateID . '" AND Discriminator="hears" AND PersonID="' . $person->getID () . '"' );
		if ($row = $result->fetch_array ( MYSQLI_ASSOC )['PersonID']) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 *
	 * @return date
	 */
	public function getDate() {
		return $this->_date;
	}
	
	/**
	 * return date like "january 2013"
	 *
	 * @return string
	 */
	public function getMonthYear() {
		$time = strtotime ( $this->_date );
		
		return date ( "F Y", $time );
	}
	
	/**
	 * return date like "1st Feb"
	 *
	 * @return string
	 */
	public function getDayMonth() {
		$time = strtotime ( $this->_date );
		
		return date ( "jS M", $time );
	}
	
	/**
	 * returns total sum of maximum points for all questions
	 *
	 * @return number
	 */
	public function getMaxPoints() {
		$questions = $this->getQuestions ();
		$maxPoints = 0;
		foreach ( $questions as $question ) {
			$maxPoints += $question->getMaxPoints ();
		}
		return $maxPoints;
	}
	
	/**
	 *
	 * @return @see Course
	 */
	public function getCourse() {
		return $this->_course;
	}
	
	/**
	 * checks if two templates are equal
	 *
	 * @param        	
	 *
	 * @see TestTemplate $template
	 * @return boolean
	 */
	public function equals($template) {
		return $this->_testTemplateID == $template->getID ();
	}
	
	/**
	 *
	 * @param        	
	 *
	 * @see TestTemplate $a
	 * @param        	
	 *
	 * @see TestTemplate $b
	 * @return 1 when a is later scheduled than b |-1 when b is later scheduled than a |0 when they are scheduled for the same date
	 */
	public static function isLater($a, $b) {
		if (strtotime ( $a->getDate () ) == strtotime ( $b->getDate () )) {
			return 0;
		}
		return (strtotime ( $a->getDate () ) < strtotime ( $b->getDate () )) ? - 1 : 1;
	}
	
	/**
	 *
	 * @return String : id
	 */
	public function getID() {
		return $this->_testTemplateID;
	}
}
?>