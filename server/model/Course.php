<?php
require_once(realpath(dirname(__FILE__)) . '/Person.php');
// require_once(realpath(dirname(__FILE__)) . '/../controller/CourseManager.php');
// require_once(realpath(dirname(__FILE__)) . '/Teacher.php');
// require_once(realpath(dirname(__FILE__)) . '/TestTemplate.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Course {
	/**
	 * @AttributeType int
	 */
	private $_courseID;
	private $_groupID;
	/**
	 * @AttributeType String
	 */
	private $_name;
	private $_syllabus;
	private $_schedule;
	
	/**
	 * @AssociationType Server.Model.Person
	 * @AssociationMultiplicity *
	 */
	public $_students = array();
	/**
	 * @AssociationType Server.Controller.CourseManager
	 */
	public $_unnamed_CourseManager_;
	/**
	 * @AssociationType Server.Model.Teacher
	 * @AssociationMultiplicity 1
	 */
	public $_courses;
	/**
	 * @AssociationType Server.Model.TestTemplate
	 * @AssociationMultiplicity 1..*
	 * @AssociationKind Aggregation
	 */
	public $_templates = array();
	
	public function __construct($courseID,$groupID) {
		$mysqli = DBController::getConnection ();
		$result = $mysqli->query ( 'SELECT * FROM Course WHERE CourseID="' . $courseID . '" AND GroupID="'. $groupID .'"');
		$row = $result->fetch_array ( MYSQLI_ASSOC );
	
		$this->_courseID = $row ['CourseID'];
		$this->_groupID = $row ['GroupID'];
		$this->_name = $row ['Name'];
		$this->_syllabus = $row ['Syllabus'];
		$this->_schedule = $row ['Schedule'];
	
		$result->close();
	}
	
	public function getName(){
		return $this->_name;
	}
}
?>