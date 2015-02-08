<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/../controller/DBController.php');
require_once (realpath ( dirname ( __FILE__ ) ) . '/TestTemplate.php');
require_once (realpath ( dirname ( __FILE__ ) ) . '/Person.php');
// require_once(realpath(dirname(__FILE__)) . '/Answer.php');

/**
 *
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Test {
	private $_iD;
	private $_result;
	private $_grade;
	private $_answerID;
	private $person;
	private $testTemplate;
	//
	public function __construct($id) {
		$mysqli = DBController::getConnection ();
		
		if ($result = $mysqli->query ( 'SELECT * FROM Test WHERE TestID="' . $id . '"' )) {
			$row = $result->fetch_array ( MYSQLI_ASSOC );
			
			$this->_iD = $row ['TestID'];
			$this->testTemplate = new TestTemplate ( $row ['TestTemplateID'] );
			$this->person = new Person ( $row ['PersonID'] );
			$this->_result = $row ['Result'];
			$this->_grade = $row ['Grade'];
			
			$result->free ();
		} else {
			echo "<script>console.log(\"" . __CLASS__ . "->" . __METHOD__ . " failed DB response\")</script>";
		}
		
		$mysqli->close ();
	}
	
	//
	public function getTestTemplate() {
		return $this->testTemplate;
	}
	
	//
	public function getResult() {
		return $this->_result;
	}
	
	//
	public function getID() {
		return $this->_iD;
	}
	
	//
	public static function upload($testTemplate, $person, $grade = NULL, $result = NULL) {
		$mysqli = DBController::getConnection ();
		
		$query = 'INSERT INTO Test (TestTemplateID, PersonID, Grade, Result)
				VALUES (' . $testTemplate . ',' . $person . ',' . (isset ( $grade ) ? $grade : "NULL") . ',' . (isset ( $result ) ? $result : "NULL") . ');';
		if ($result = $mysqli->query ( $query )) {
			return $mysqli->insert_id;
		} else {
			// insert failed
			return $mysqli->error;
		}
	}
	
	//
	public function getAnswers() {
		$mysqli = DBController::getConnection ();
		
		if ($result = $mysqli->query ( 'SELECT AnswerID FROM Answer
				WHERE TestID="' . $this->_iD . '" ORDER BY QuestionID' )) {
			$answers = array ();
			while ( $row = $result->fetch_array ( MYSQLI_ASSOC ) ) {
				array_push ( $answers, Answer::getAnswer ( $row ['AnswerID'] ) );
			}
			return $answers;
		} else {
			echo "<script>console.log(\"" . __CLASS__ . "->" . __METHOD__ . " failed DB response\")</script>";
		}
	}
	
	//
	public function ownedBy($person) {
		return $this->person->equals ( $person );
	}
	
	//
	public static function getTestContent($Testid) {
		return $tests;
	}
}
?>