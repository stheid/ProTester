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
	public $_answers = array ();
	
	/**
	 *
	 * @access public
	 * @param
	 *        	aAnswers
	 */
	public function setAnswers($aAnswers) {
		// Not yet implemented
	}
	
	/**
	 *
	 * @access public
	 */
	public function getAnswers() {
		// Not yet implemented
	}
	public function __construct($id) {
		$mysqli = DBController::getConnection ();
		
		$result = $mysqli->query ( "SELECT * FROM Test WHERE TestID=" . $id );
		$row = $result->fetch_array ( MYSQLI_ASSOC );
		
		$this->_iD = $row ['TestID'];
		$this->testTemplate = new TestTemplate ( $row ['TestTemplateID'] );
		$this->person = new Person ( $row ['PersonID'] );
		$this->_result = $row ['Result'];
		$this->_grade = $row ['Grade'];
		
		$result->free ();
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
		
		$str = 'INSERT INTO Test (TestTemplateID, PersonID, Grade, Result)
				VALUES (' . $testTemplate . ',' . $person . ',' . (isset ( $grade ) ? $grade : "NULL") . ',' . (isset ( $result ) ? $result : "NULL") . ');';
		if ($result = $mysqli->query ( $str )) {
			return $mysqli->insert_id;
		} else {
			// insert failed
			return $mysqli->error;
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