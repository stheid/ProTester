<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/../controller/DBController.php');
// require_once(realpath(dirname(__FILE__)) . '/TestTemplate.php');
// require_once(realpath(dirname(__FILE__)) . '/Student.php');
// require_once(realpath(dirname(__FILE__)) . '/Person.php');
// require_once(realpath(dirname(__FILE__)) . '/../controller/TestManager.php');
// require_once(realpath(dirname(__FILE__)) . '/../controller/AnswerPointsManager.php');
// require_once(realpath(dirname(__FILE__)) . '/Answer.php');

/**
 *
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Test {
	/**
	 * @AttributeType int
	 */
	private $_iD;
	/**
	 * @AttributeType Integer
	 */
	private $_result;
	/**
	 * @AttributeType BigDecimal
	 */
	private $_grade;
	/**
	 * @AttributeType int
	 */
	private $_answerID;
	/**
	 * @AttributeType int
	 */
	private $_personID;
	/**
	 * @AttributeType int
	 */
	private $_personPersonalID;
	/**
	 * @AttributeType int
	 */
	private $_personStudentID;
	/**
	 * @AttributeType int
	 */
	private $_testTemplateID;
	/**
	 * @AssociationType Server.Model.TestTemplate
	 * @AssociationMultiplicity 1
	 */
	public $_is_a__;
	/**
	 * @AssociationType Server.Model.Student
	 * @AssociationMultiplicity 1
	 */
	public $_student;
	/**
	 * @AssociationType Server.Model.Person
	 * @AssociationMultiplicity 1
	 */
	public $_person;
	/**
	 * @AssociationType Server.Controller.TestManager
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_TestManager_;
	/**
	 * @AssociationType Server.Controller.AnswerPointsManager
	 */
	public $_updates_;
	/**
	 * @AssociationType Server.Model.Answer
	 * @AssociationMultiplicity *
	 * @AssociationKind Aggregation
	 */
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
		
		$result = $mysqli->query ( "SELECT * FROM test WHERE ID=" . $id );
		$row = $result->fetch_array ( MYSQLI_ASSOC );
		
		$this->_iD = $row ['ID'];
		$this->_result = $row ['Result'];
		$this->_grade = $row ['Grade'];
		$this->_answerID = $row ['AnswerID'];
		$this->_personID = $row ['PersonID'];
		$this->_personPersonalID = $row ['PersonPersonalID'];
		$this->_personStudentID = $row ['PersonStudentID'];
		$this->_testID = $row ['TestTemplateID'];
	}
	
	// read from testtemplate
	public function getDate() {
		$mysqli = DBController::getConnection ();
		
		$result = $mysqli->query ( "SELECT date FROM TestTemplate WHERE TestTemplateID=" . $this->_testTemplateID );
		return $result->fetch_array ( MYSQLI_ASSOC )['date'];
	}
}
?>