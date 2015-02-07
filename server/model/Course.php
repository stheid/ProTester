<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/Person.php');
// require_once(realpath(dirname(__FILE__)) . '/../controller/CourseManager.php');
// require_once(realpath(dirname(__FILE__)) . '/Teacher.php');
// require_once(realpath(dirname(__FILE__)) . '/TestTemplate.php');

/**
 *
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
	public $_students = array ();
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
	public $_templates = array ();
	public function __construct($courseID, $groupID) {
		$mysqli = DBController::getConnection ();
		$result = $mysqli->query ( 'SELECT * FROM Course WHERE CourseID="' . $courseID . '" AND GroupID="' . $groupID . '"' );
		$row = $result->fetch_array ( MYSQLI_ASSOC );
		
		$this->_courseID = $row ['CourseID'];
		$this->_groupID = $row ['GroupID'];
		$this->_name = $row ['Name'];
		$this->_syllabus = $row ['Syllabus'];
		$this->_schedule = $row ['Schedule'];
		
		$result->close ();
	}
	public function getName() {
		return $this->_name;
	}
	public function equalsCourse($courseID) {
		return $this->_courseID == $courseID;
	}
	public function equals($courseID,$groupID) {
		return ($this->_courseID == $courseID && $this->_groupID == $groupID);
	}

	public function getCourseID(){
		return $this->_courseID;
	}
	public function getGroupID(){
		return $this->_groupID;
	}

	public function getGroupName(){
		$groupTypeNumber=$this->_groupID >> 3;
		$groupNumber=$this->_groupID % 8 + 1;
		
		$groupName="";
		
		switch ($groupTypeNumber) {
			case 0:
				$groupName = "Lecture ";
				break;
			case 1:
				$groupName = "Project ";
				break;
			case 2:
				$groupName = "Lab ";
				break;
			case 0:
				$groupName = "Seminar ";
				break;
			case 1:
				$groupName = "Class ";
				break;
			default:
				$groupName = "unknown Groupname";
				break;
		}
		
		return $groupName.$groupNumber;
	}
	
	public function getTestTemplates(){
		$mysqli = DBController::getConnection ();
		
		$result = $mysqli->query ( 'SELECT TestTemplateID FROM TestTemplate Where CourseID="'.$this->_courseID.'" AND GroupID="'.$this->_groupID.'" ORDER BY date');
		// delegate the test class to create test objects according testid (call the constructor in a loop)
		$testTemplates = array ();
		while ( $row = $result->fetch_array ( MYSQLI_ASSOC ) ) {
			array_push ( $testTemplates, new TestTemplate ( $row ['TestTemplateID'] ) );
		}
		// return this array of objects
		$result->close ();
		
		return $testTemplates;
	}
}
?>